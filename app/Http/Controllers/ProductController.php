<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sort = $request->input('sort', 'newest');

        $productsQuery = Product::query();

        if (!empty($query)) {
            $productsQuery->where(function ($sub) use ($query) {
                $sub->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('type', 'LIKE', "%{$query}%");
            });
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

        return view('pages.ProductListing', compact('products', 'query', 'types', 'type', 'minPrice', 'maxPrice', 'sort'));
    }

    /**
     * Updated: Points to the high-quality Overview page
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Updated path to match your 'pages' organization
        return view('pages.product-overview', compact('product'));
    }

    public function purchase($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.basket', compact('product'));
    }
}