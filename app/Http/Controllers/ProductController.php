<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass products to the view
        return view('frontend.index', compact('products'));
    }

    public function show($id)
    {
        // Find product by ID or fail
        $product = Product::findOrFail($id);

        // Pass product to the purchase page
        return view('products.show', compact('product'));
    }
}