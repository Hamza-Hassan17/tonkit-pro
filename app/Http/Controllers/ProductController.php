<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = collect(config('products.list'));

        return view('products.index', compact('products'));
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
