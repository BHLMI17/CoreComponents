<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Product listing + filters + search
    public function index(Request $request)
    {
        $query = trim($request->input('query') ?? $request->input('q'));
        $type = $request->input('type');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sort = $request->input('sort', 'newest');

        $productsQuery = Product::query();

        if (!empty($query)) {
            $lower = strtolower($query);
            $productsQuery->whereRaw('LOWER(name) LIKE ?', ["%$lower%"])
                ->orWhereRaw('LOWER(description) LIKE ?', ["%$lower%"])
                ->orWhereRaw('LOWER(type) LIKE ?', ["%$lower%"]);
        }

        if (!empty($type)) {
            $productsQuery->where('type', $type);
        }

        if ($minPrice !== null && $minPrice !== '') {
            $productsQuery->where('price', '>=', (float) $minPrice);
        }

        if ($maxPrice !== null && $maxPrice !== '') {
            $productsQuery->where('price', '<=', (float) $maxPrice);
        }

        if ($sort === 'price_asc') {
            $productsQuery->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $productsQuery->orderBy('price', 'desc');
        } else {
            $productsQuery->orderBy('created_at', 'desc');
        }

        $products = $productsQuery->get();
        $types = Product::select('type')->distinct()->orderBy('type')->pluck('type');

        return view('pages.ProductListing', compact(
            'products', 'query', 'types', 'type', 'minPrice', 'maxPrice', 'sort'
        ));
    }

    // Dedicated search route for navbar
    public function search(Request $request)
    {
        $query = trim($request->input('query'));
        $lower = strtolower($query);

        $products = Product::whereRaw('LOWER(name) LIKE ?', ["%$lower%"])
            ->orWhereRaw('LOWER(description) LIKE ?', ["%$lower%"])
            ->orWhereRaw('LOWER(type) LIKE ?', ["%$lower%"])
            ->get();

        return view('pages.search-results', compact('products', 'query'));
    }

    /**
     * Display the product overview with dynamic review analytics.
     */
    public function show($id)
    {
        // 1. Fetch the product with its reviews
        $product = Product::with('reviews')->findOrFail($id);
        
        // 2. Calculate basic stats
        $totalReviews = $product->reviews->count();
        $avgRating = $totalReviews > 0 ? $product->reviews->avg('rating') : 0;

        // 3. Calculate breakdown for the 5-level rating stack
        $starCounts = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $product->reviews->where('rating', $i)->count();
            // Calculate percentage for CSS bar width
            $starCounts[$i] = [
                'count' => $count,
                'percent' => $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0
            ];
        }

        return view('pages.product-overview', compact('product', 'totalReviews', 'avgRating', 'starCounts'));
    }

    public function purchase($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.basket', compact('product'));
    }
}