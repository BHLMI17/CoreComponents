<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BasketController;
use App\Models\Product;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


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
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');

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


// Email verifcation

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard');
})->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/admin/login', function () {
    return view('auth.login');
})->name('admin.login');

Route::middleware(['auth', 'can:admin-only'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.dashboard');
}); 



require __DIR__.'/auth.php';

