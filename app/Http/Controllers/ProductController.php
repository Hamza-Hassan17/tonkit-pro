<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = trim((string) $request->input('q', ''));

        $products = collect(config('products.list'));

        if ($query !== '') {
            $products = $products->filter(fn ($p) => str_contains(
                strtolower($p['name'].' '.$p['description'].' '.$p['sku']),
                strtolower($query)
            ))->values();
        }

        return view('products.index', compact('products', 'query'));
    }

    public function show(string $slug)
    {
        $product = collect(config('products.list'))
            ->firstWhere('slug', $slug);

        abort_if(! $product, Response::HTTP_NOT_FOUND);

        // "Related" caps — anything else in the catalog, capped at 4.
        $related = collect(config('products.list'))
            ->reject(fn ($p) => $p['slug'] === $slug)
            ->take(4);

        return view('products.show', compact('product', 'related'));
    }

    /**
     * Small static helper so controllers/views can look a product up by slug
     * without repeating the collect()/firstWhere() every time.
     */
    public static function find(string $slug): ?array
    {
        return collect(config('products.list'))->firstWhere('slug', $slug);
    }
}
