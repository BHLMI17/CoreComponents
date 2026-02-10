<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // SINGLE, CLEAN index() METHOD 
    public function index(Request $request)
    {
        // Accept both ?q= and ?query=
        $query = $request->input('query') ?? $request->input('q');

        $type = $request->input('type');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sort = $request->input('sort', 'newest');

        $productsQuery = Product::query();

        // Search logic
        if (!empty($query)) {
            $productsQuery->where(function ($sub) use ($query) {
                $sub->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('type', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%");
            });
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

    // Dedicated search method for navbar 
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('type', 'LIKE', "%{$query}%")
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
