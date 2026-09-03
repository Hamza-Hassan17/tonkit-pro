<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ── Public pages ────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ── Products (static catalog of 9 caps) ─────────────────────────
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// ── Cart (session-based, no login required to browse/add) ───────
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{slug}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{slug}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{slug}', [CartController::class, 'remove'])->name('cart.remove');

// ── Checkout (login required — this is the "LOGIN TO ORDER" gate) ─
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/paypal', [PayPalController::class, 'create'])->name('checkout.paypal');
});

Route::get('/checkout/success', [PayPalController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [PayPalController::class, 'cancel'])->name('checkout.cancel');

// ── Order history for logged-in customers ───────────────────────
Route::middleware('auth')->get('/my-orders', [CheckoutController::class, 'orders'])->name('orders.index');

// ── Breeze: dashboard + profile ──────────────────────────────────
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
