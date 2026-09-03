<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = trim((string) $request->input('q', ''));

        $products = self::all();

        if ($query !== '') {
            $needle = strtolower($query);
            $products = $products->filter(fn ($p) => str_contains(
                strtolower($p['name'].' '.$p['brand'].' '.$p['description'].' '.$p['sku']),
                $needle
            ))->values();
        }

        return view('products.index', compact('products', 'query'));
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
     * (the first color's image) for cards and listings.
     */
    public static function all(): Collection
    {
        return collect(config('products.list'))->map(function ($p) {
            $p['image'] = $p['colors'][0]['image'] ?? null;
            return $p;
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
