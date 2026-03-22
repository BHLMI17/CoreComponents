<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Support\DatabaseAvailability;

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
        return DatabaseAvailability::fallback(function () use ($validated, $productId) {
            Review::create([
                'product_id' => $productId,
                'user_name' => $validated['user_name'],
                'rating' => $validated['rating'],
                'title' => $validated['title'],
                'comment' => $validated['comment'],
            ]);

            return back()->with('success', 'Thank you! Your review has been submitted.');
        }, fn () => back()->with('error', DatabaseAvailability::warningMessage()));
    }
}
