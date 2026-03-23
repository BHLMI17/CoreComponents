<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ReviewController;
use App\Models\Product;
use App\Models\Review;
use App\Models\WebsiteReview;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\BottleneckController;
use App\Support\DatabaseAvailability;


// Public pages
Route::get('/', function () { // ts for landing pages
    $categories = ['mouse', 'keyboard', 'cpu', 'gpu', 'monitor'];

    return DatabaseAvailability::fallback(function () use ($categories) {
        $featuredProducts = Product::with('reviews')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $productsByCategory = [];
        foreach ($categories as $cat) {
            $productsByCategory[$cat] = Product::where('type', $cat)
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
        }

        return view('pages.Landing', compact('featuredProducts', 'categories', 'productsByCategory'));
    }, function () use ($categories) {
        $productsByCategory = collect($categories)
            ->mapWithKeys(fn ($category) => [$category => collect()])
            ->all();

        return view('pages.Landing', [
            'featuredProducts' => collect(),
            'categories' => $categories,
            'productsByCategory' => $productsByCategory,
            'databaseWarning' => DatabaseAvailability::warningMessage(),
        ]);
    });
})->name('landing');

Route::view('/contact', 'pages.Contact')->name('contact');

//About us
Route::get('/about-us', function () {
    return DatabaseAvailability::fallback(function () {
        $topRatedProducts = \App\Models\Product::withAvg('reviews', 'rating')
            ->orderBy('reviews_avg_rating', 'desc')
            ->take(4)
            ->get();

        $websiteReviews = \App\Models\WebsiteReview::latest()->take(3)->get();

        return view('pages.about_us', compact('topRatedProducts', 'websiteReviews'));
    }, fn () => view('pages.about_us', [
        'topRatedProducts' => collect(),
        'websiteReviews' => collect(),
        'databaseWarning' => DatabaseAvailability::warningMessage(),
    ]));
})->name('about');

// --- ADD THE STORE ROUTE FOR WEBSITE REVIEWS ---
Route::post('/website-review', function (Request $request) {
    $validated = $request->validate([
        'user_name' => 'required|string|max:255',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string',
    ]);

    return DatabaseAvailability::fallback(function () use ($validated) {
        WebsiteReview::create($validated);

        return back()->with('success', 'Thank you for your feedback!');
    }, fn () => back()->with('error', DatabaseAvailability::warningMessage()));
})->name('website-reviews.store');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.list');

/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
|
| Handles product search queries from the navbar search bar.
|
*/
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/api/search-suggestions', [ProductController::class, 'searchSuggestions'])->name('search.suggestions');

// Product Overview
Route::post('/products/{productId}/review', [ReviewController::class, 'store'])->name('reviews.store');

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




Route::get('/admin/login', function () {
    return view('auth.login');
})->name('admin.login');

Route::middleware(['auth', 'can:admin-only'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.dashboard');
}); 

use App\Http\Controllers\OrderController;

Route::middleware('auth')->group(function () {
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

Route::get('/bottleneck', [BottleneckController::class, 'index'])
    ->name('bottleneck.index');
Route::post('/bottleneck/calc', [BottleneckController::class, 'calculate'])
    ->name('bottleneck.calculate');

require __DIR__.'/auth.php';
