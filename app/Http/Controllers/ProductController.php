<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request)
{
    // Keep your existing search param (?q=...)
    $query = $request->input('q');

    // New filter params 
    $type     = $request->input('type');           // exact type e.g like mouse
    $minPrice = $request->input('min_price');      // number
    $maxPrice = $request->input('max_price');      // number
    $sort     = $request->input('sort', 'newest'); // newest / price_asc / price_desc

    // Build the query
    $productsQuery = Product::query();

    // Search by name or type 
    if (!empty($query)) {
        $productsQuery->where(function ($sub) use ($query) {
            $sub->where('name', 'LIKE', "%{$query}%")
                ->orWhere('type', 'LIKE', "%{$query}%");
        });
    }

    // Filter by exact type
    if (!empty($type)) {
        $productsQuery->where('type', $type);
    }

    // Price range
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

    // Get results. nts change pagnation cuz no need for allat
   $products = $productsQuery->get();


    // Types for dropdown
    $types = Product::select('type')->distinct()->orderBy('type')->pluck('type');

    return view('pages.ProductListing', compact('products', 'query', 'types', 'type', 'minPrice', 'maxPrice', 'sort'));
}



    public function show($id)
    {
        // Find product by ID or fail
        $product = Product::findOrFail($id);

        // Pass product to the purchase page
        return view('frontend.show', compact('product'));
    }

    public function purchase($id)
    {
        // Find product by ID or fail
        $product = Product::findOrFail($id);


        
        // Pass product to the purchase page
        return view('frontend.basket', compact('product'));
    }
}