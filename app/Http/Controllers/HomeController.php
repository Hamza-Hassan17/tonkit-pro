<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        // Show all 9 products on the home page grid, same as the mockup.
        $products = ProductController::all();

        return view('home', compact('products'));
    }
}
