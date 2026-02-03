<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BasketController;
use App\Models\Product;

// Public pages
Route::get('/', function () { // ts for landing pages

    // Featured: newest 8 (or whatever we tryna do)
    $featuredProducts = Product::orderBy('created_at', 'desc')->take(8)->get();

    // Section categories
    $categories = ['mouse', 'keyboard', 'cpu', 'gpu', 'monitor'];

    // Grab a few items per category (e.g. 4 each)
    $productsByCategory = [];
    foreach ($categories as $cat) {
        $productsByCategory[$cat] = Product::where('type', $cat)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
    }

    return view('pages.Landing', compact('featuredProducts', 'categories', 'productsByCategory'));
})->name('landing');

Route::view('/contact', 'pages.Contact')->name('contact');
Route::view('/about-us', 'pages.about_us')->name('about');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.list');

// Product Overview
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// Basket (guest + user)
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
Route::put('/basket/update/{id}', [BasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/remove/{id}', [BasketController::class, 'destroy'])->name('basket.remove');
Route::delete('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');

// Checkout (guest allowed)
Route::get('/checkout', [BasketController::class, 'checkout'])->name('checkout');

// Dashboard (auth only)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

// Profile (auth only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';