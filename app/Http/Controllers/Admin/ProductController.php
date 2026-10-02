<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use App\Support\ProductImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->input('q', ''));
        $tag = $request->input('tag', '');

        $products = Product::with(['colors', 'tags'])
            ->when($query !== '', fn ($q) => $q->where(fn ($q2) => $q2
                ->where('name', 'like', "%{$query}%")
                ->orWhere('sku', 'like', "%{$query}%")))
            ->when($tag !== '', fn ($q) => $q->whereHas('tags', fn ($q2) => $q2->where('key', $tag)))
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        $tags = Tag::orderBy('label')->get();

        return view('admin.products.index', compact('products', 'query', 'tag', 'tags'));
    }

    public function create()
    {
        $product = new Product(['pricing_tiers' => [0, 0, 0]]);
        $tags = Tag::orderBy('label')->get();

        return view('admin.products.form', compact('product', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedBasics($request);
        $this->validateColorImages($request);
        $data['slug'] = Str::slug($data['name']);

        if (Product::withTrashed()->where('slug', $data['slug'])->exists()) {
            return back()->withInput()->withErrors(['name' => 'A product with this name (slug) already exists.']);
        }

        $product = DB::transaction(function () use ($data, $request) {
            $product = Product::create($data);
            $this->syncSpecs($product, $request);
            $this->syncTags($product, $request);
            $this->syncColors($product, $request);

            return $product;
        });

        return redirect()->route('admin.products.edit', $product)->with('success', "\"{$product->name}\" created.");
    }

    public function edit(Product $product)
    {
        $product->load(['colors', 'tags']);
        $tags = Tag::orderBy('label')->get();

        return view('admin.products.form', compact('product', 'tags'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validatedBasics($request);
        $this->validateColorImages($request);
        // Slug is immutable after creation -- protects image folder paths
        // and historical order_items.product_slug snapshots.
        unset($data['slug']);

        DB::transaction(function () use ($product, $data, $request) {
            $product->update($data);
            $this->syncSpecs($product, $request);
            $this->syncTags($product, $request);
            $this->syncColors($product, $request);
        });

        return redirect()->route('admin.products.edit', $product)->with('success', "\"{$product->name}\" saved.");
    }

    public function destroy(Product $product)
    {
        $hasOrders = \App\Models\OrderItem::where('product_slug', $product->slug)->exists();

        $product->delete(); // soft delete

        $msg = "\"{$product->name}\" deleted.";
        if ($hasOrders) {
            $msg .= ' Note: it appears in past orders, which still reference it by name — those are unaffected.';
        }

        return redirect()->route('admin.products.index')->with('success', $msg);
    }

    private function validatedBasics(Request $request): array
    {
        $data = $request->validate([
            'name'              => ['required', 'string', 'max:120'],
            'brand'             => ['required', 'string', 'max:60'],
            'card_label'        => ['nullable', 'string', 'max:40'],
            'sku'               => ['required', 'string', 'max:60'],
            'description'       => ['required', 'string'],
            'price'             => ['required', 'numeric', 'min:0'],
            'pricing_tiers'     => ['required', 'array', 'size:3'],
            'pricing_tiers.*'   => ['required', 'numeric', 'min:0'],
        ]);

        if ($data['pricing_tiers'][0] < $data['pricing_tiers'][1] || $data['pricing_tiers'][1] < $data['pricing_tiers'][2]) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'pricing_tiers' => 'Tier prices should decrease (or stay equal) as quantity goes up: 12-72 ≥ 73-144 ≥ 145+.',
            ]);
        }

        return $data;
    }

    private function validateColorImages(Request $request): void
    {
        $request->validate([
            'colors.*.image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:8192', 'dimensions:min_width=200,min_height=200'],
            'colors.*.name'  => ['required_without:colors.*.id', 'nullable', 'string', 'max:60'],
            'colors.*.hex'   => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
        ]);
    }

    private function syncSpecs(Product $product, Request $request): void
    {
        $labels = $request->input('spec_label', []);
        $values = $request->input('spec_value', []);
        $specs = [];

        foreach ($labels as $i => $label) {
            $label = trim((string) $label);
            $value = trim((string) ($values[$i] ?? ''));
            if ($label === '' || $value === '') {
                continue;
            }
            $specs[$label] = $value; // later duplicate labels overwrite earlier ones
        }

        $product->update(['specs' => $specs]);
    }

    private function syncTags(Product $product, Request $request): void
    {
        $tagIds = collect($request->input('tags', []))->filter()->map(fn ($id) => (int) $id)->all();
        $product->tags()->sync($tagIds);
    }

    private function syncColors(Product $product, Request $request): void
    {
        $rows = $request->input('colors', []);
        $files = $request->file('colors', []);
        $existingIds = $product->colors()->pluck('id')->all();
        $keptIds = [];
        $order = 0;

        foreach ($rows as $i => $row) {
            if ($request->boolean("colors.{$i}._delete")) {
                continue;
            }

            $name = trim((string) ($row['name'] ?? ''));
            $slug = Str::slug($row['slug'] ?? $name);
            $hex = $row['hex'] ?? '#000000';
            if ($name === '' || $slug === '') {
                continue;
            }

            $id = $row['id'] ?? null;
            $uploadedFile = $files[$i]['image'] ?? null;

            $imagePath = $row['existing_image'] ?? null;
            if ($uploadedFile) {
                ProductImageUploader::delete($imagePath);
                $imagePath = ProductImageUploader::store($uploadedFile, $product->slug, $slug);
            }

            if (! $imagePath) {
                continue; // a brand-new color row with no image yet -- skip rather than save a broken reference
            }

            $attrs = ['name' => $name, 'slug' => $slug, 'hex' => $hex, 'image_path' => $imagePath, 'sort_order' => $order];

            // Match by submitted id first; if that's missing/stale, fall back
            // to matching by slug within this product rather than attempting
            // an insert that would violate the per-product slug uniqueness
            // constraint (e.g. a row whose id got out of sync with the form).
            $color = ($id && in_array((int) $id, $existingIds, true))
                ? $product->colors()->find($id)
                : $product->colors()->where('slug', $slug)->first();

            if ($color) {
                $color->update($attrs);
            } else {
                $color = $product->colors()->create($attrs);
            }
            $keptIds[] = $color->id;
            $order++;
        }

        // Delete rows removed/unticked from the form, including their files.
        foreach (array_diff($existingIds, $keptIds) as $goneId) {
            $gone = $product->colors()->find($goneId);
            if ($gone) {
                ProductImageUploader::delete($gone->image_path);
                $gone->delete();
            }
        }
    }
}
