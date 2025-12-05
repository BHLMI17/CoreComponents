<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

// // ✅ Static Blade views (now in resources/views/pages)
// Route::view('/', 'pages.Landing')->name('landing');
// Route::view('/about-us', 'pages.about_us')->name('about');
// Route::view('/contact', 'pages.Contact')->name('contact');
// Route::view('/checkout', 'pages.checkout')->name('checkout');

// // ✅ Product listing (dynamic)
// Route::get('/ProductListing', [ProductController::class, 'index'])->name('products.list');

// // ✅ Optional cleaner alias for product listing
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::view('/', 'pages.Landing')->name('landing');
Route::view('/contact', 'pages.Contact')->name('contact');
Route::view('/about-us', 'pages.about_us')->name('about');
Route::view('/checkout', 'pages.checkout')->name('checkout');

Route::get('/products', [ProductController::class, 'index'])->name('products.list');


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