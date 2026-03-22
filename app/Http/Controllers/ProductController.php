<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\DatabaseAvailability;
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

        $data = DatabaseAvailability::fallback(function () use ($query, $type, $minPrice, $maxPrice, $sort) {
            $productsQuery = Product::with('reviews');

            if (! empty($query)) {
                $lower = strtolower($query);
                $productsQuery->where(function ($builder) use ($lower) {
                    $builder->whereRaw('LOWER(name) LIKE ?', ["%$lower%"])
                        ->orWhereRaw('LOWER(description) LIKE ?', ["%$lower%"])
                        ->orWhereRaw('LOWER(type) LIKE ?', ["%$lower%"]);
                });
            }

            if (! empty($type)) {
                $productsQuery->where('type', strtolower($type));
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

            return [
                'products' => $productsQuery->get(),
                'types' => Product::select('type')->distinct()->orderBy('type')->pluck('type'),
                'databaseWarning' => null,
            ];
        }, [
            'products' => collect(),
            'types' => collect(),
            'databaseWarning' => DatabaseAvailability::warningMessage(),
        ]);

        return view('pages.ProductListing', array_merge($data, compact(
            'query', 'type', 'minPrice', 'maxPrice', 'sort'
        )));
    }

    // Dedicated search route for navbar (Redirect to products list instead of breaking if view does not exist)
    public function search(Request $request)
    {
        $query = $request->input('query');

        // If empty search, redirect back with message
        if (!$query) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        // Redirect to the products listing page with the query parameter
        return redirect()->route('products.list', ['query' => $query]);
    }

    // API Endpoint for Navbar Search Suggestions
    public function searchSuggestions(Request $request)
    {
        $query = $request->input('query');

        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $lower = strtolower($query);

        $products = DatabaseAvailability::fallback(function () use ($lower) {
            return Product::where(function ($builder) use ($lower) {
                $builder->whereRaw('LOWER(name) LIKE ?', ["%$lower%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%$lower%"])
                    ->orWhereRaw('LOWER(type) LIKE ?', ["%$lower%"]);
            })
                ->select('id', 'name', 'price', 'image_url')
                ->take(5)
                ->get();
        }, collect());

        return response()->json($products);
    }

    /**
     * Display the product overview with dynamic review analytics.
     */
    public function show($id)
    {
        // 1. Fetch the product with its reviews
        return DatabaseAvailability::fallback(function () use ($id) {
            $product = Product::with('reviews')->findOrFail($id);

            $totalReviews = $product->reviews->count();
            $avgRating = $totalReviews > 0 ? $product->reviews->avg('rating') : 0;

            $starCounts = [];
            for ($i = 5; $i >= 1; $i--) {
                $count = $product->reviews->where('rating', $i)->count();
                $starCounts[$i] = [
                    'count' => $count,
                    'percent' => $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0,
                ];
            }

            return view('pages.product-overview', compact('product', 'totalReviews', 'avgRating', 'starCounts'));
        }, fn () => redirect()->route('products.list')->with('error', DatabaseAvailability::warningMessage()));
    }

    public function purchase($id)
    {
        return DatabaseAvailability::fallback(function () use ($id) {
            $product = Product::findOrFail($id);

            return view('frontend.basket', compact('product'));
        }, fn () => redirect()->route('products.list')->with('error', DatabaseAvailability::warningMessage()));
    }
}
