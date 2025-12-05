<?php

use App\Http\Controllers\Frontend\frontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// ✅ Home page now points to your public/index.php (or landing.php if preferred)
Route::get('/', function () {
    return redirect('/Landing.php');   // or '/landing.php'
});

// ✅ Static pages now in public/
Route::get('/about-us', function () {
    return redirect('/about_us.php');
});

Route::get('/contact', function () {
    return redirect('/contact.php');
});

Route::get('/checkout', function () {
    return redirect('/checkout.php');
});

Route::get('/landing', function () {
    return redirect('/landing.php');
});

Route::get('/product-listing', function () {
    return redirect('/products.php');
});

// ✅ Product controller routes (these stay as-is)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// ✅ Dashboard + Auth
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';