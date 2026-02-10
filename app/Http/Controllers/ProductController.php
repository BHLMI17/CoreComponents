<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Product listing + filters + search (?q= or ?query=)
    public function index(Request $request)
    {
        // Accept both ?q= and ?query=
        $query = trim($request->input('query') ?? $request->input('q'));

        $type = $request->input('type');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sort = $request->input('sort', 'newest');

        $productsQuery = Product::query();

        // Search logic
        if (!empty($query)) {
            $lower = strtolower($query);

            $productsQuery->whereRaw('LOWER(name) LIKE ?', ["%$lower%"])
                ->orWhereRaw('LOWER(description) LIKE ?', ["%$lower%"])
                ->orWhereRaw('LOWER(type) LIKE ?', ["%$lower%"]);
        }

        // Filters
        if (!empty($type)) {
            $productsQuery->where('type', $type);
        }

        if ($minPrice !== null && $minPrice !== '') {
            $productsQuery->where('price', '>=', (float) $minPrice);
        }

        if ($maxPrice !== null && $maxPrice !== '') {
            $productsQuery->where('price', '<=', (float) $maxPrice);
        }

        // Sorting
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
            'products',
            'query',
            'types',
            'type',
            'minPrice',
            'maxPrice',
            'sort'
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

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product-overview', compact('product'));
    }

    public function purchase($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.basket', compact('product'));
    }
}
