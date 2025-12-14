<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BasketController;

Route::view('/', 'pages.Landing')->name('landing');
Route::view('/contact', 'pages.Contact')->name('contact');
Route::view('/about-us', 'pages.about_us')->name('about');

Route::get('/products', [ProductController::class, 'index'])->name('products.list');

// Dashboard + Auth
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Basket/Cart routes - PROTECTED BY AUTH
Route::middleware(['auth'])->group(function () {
    Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
    Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
    Route::put('/basket/update/{id}', [BasketController::class, 'update'])->name('basket.update');
    Route::delete('/basket/remove/{id}', [BasketController::class, 'destroy'])->name('basket.remove');
    Route::delete('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');
    
    Route::view('/checkout', 'pages.checkout.checkout')->name('checkout');
});


Route::middleware('auth')->group(function () {
    Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
    Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
    Route::get('/checkout', [BasketController::class, 'checkout'])->name('checkout');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';