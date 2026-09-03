<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        // Show all 9 products on the home page grid, same as the mockup.
        $products = collect(config('products.list'));

        return view('home', compact('products'));
    }
}
