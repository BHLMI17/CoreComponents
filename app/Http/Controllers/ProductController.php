<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    // Get the search query from the URL (?q=...)
    $query = $request->input('q');

    // Fetch products, filtered if a search query exists
    $products = Product::when($query, function ($q) use ($query) {
        $q->where('name', 'LIKE', '%' . $query . '%')
          ->orWhere('type', 'LIKE', '%' . $query . '%');
    })->get();

    // Pass products + query back to the view
    return view('pages.ProductListing', compact('products', 'query'));
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
        return view('frontend.basket', compact('product-basket'));
    }
}