<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /** Per-request memoization -- find() is called multiple times per
     *  request (CartController::add(), cartWithProductData() per line,
     *  show(), OrderItem::product() per line); this was free when the
     *  catalog was a config array, now it's a DB query, so cache it for
     *  the life of the request rather than repeating the same lookup. */
    private static ?Collection $cache = null;

    public function index(\Illuminate\Http\Request $request)
    {
        $query = trim((string) $request->input('q', ''));
        $tag   = trim((string) $request->input('tag', ''));

        $products = self::all();

        if ($query !== '') {
            $needle = strtolower($query);
            $products = $products->filter(fn ($p) => str_contains(
                strtolower($p['name'].' '.$p['brand'].' '.$p['description'].' '.$p['sku']),
                $needle
            ))->values();
        }

        $validTags = \App\Models\Tag::pluck('key')->all();
        if ($tag !== '' && in_array($tag, $validTags, true)) {
            $products = $products->filter(fn ($p) => in_array($tag, $p['tags'], true))->values();
        } else {
            $tag = '';
        }

        return view('products.index', compact('products', 'query', 'tag'));
    }

    public function show(string $slug)
    {
        $product = self::find($slug);

        abort_if(! $product, Response::HTTP_NOT_FOUND);

        $related = self::all()
            ->reject(fn ($p) => $p['slug'] === $slug)
            ->take(4)
            ->values();

        return view('products.show', compact('product', 'related'));
    }

    /**
     * All catalog products, each decorated with a top-level `image`
     * (the first color's image) for cards and listings. Plain-array
     * shape (not Eloquent models) -- Pricing::breakdown() and
     * CartController::cartWithProductData() call array_merge() on these,
     * which throws given an object. See Product::toLegacyArray().
     */
    public static function all(): Collection
    {
        if (self::$cache !== null) {
            return self::$cache;
        }

        return self::$cache = Product::with(['colors', 'tags'])
            ->orderBy('name')
            ->get()
            ->map(function (Product $p) {
                $arr = $p->toLegacyArray();
                $arr['image'] = $arr['colors'][0]['image'] ?? null;

                return $arr;
            });
    }

    /**
     * Look a product up by slug (decorated, same shape as all()).
     */
    public static function find(string $slug): ?array
    {
        return self::all()->firstWhere('slug', $slug);
    }

    /**
     * Resolve a single color entry for a product. Falls back to the first color.
     */
    public static function color(array $product, ?string $colorSlug): array
    {
        $colors = $product['colors'] ?? [];

        return collect($colors)->firstWhere('slug', $colorSlug) ?? $colors[0] ?? [
            'name' => null, 'slug' => null, 'hex' => '#cccccc', 'image' => $product['image'] ?? null,
        ];
    }
}
