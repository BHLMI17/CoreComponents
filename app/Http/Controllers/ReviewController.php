<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        // 1. Validate the form data
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'rating'    => 'required|integer|min:1|max:5',
            'title'     => 'required|string|max:255',
            'comment'   => 'required|string',
        ]);

        // 2. Create the review linked to the product
        Review::create([
            'product_id' => $productId,
            'user_name'  => $validated['user_name'],
            'rating'     => $validated['rating'],
            'title'      => $validated['title'],
            'comment'    => $validated['comment'],
        ]);

        // 3. Redirect back with success
        return back()->with('success', 'Thank you! Your review has been submitted.');
    }
}
