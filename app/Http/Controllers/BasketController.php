<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Basket;

class BasketController extends Controller
{
    /**
     * Display all basket items for the logged‑in user.
     */
    public function index()
    {
        $identifier = auth()->check()
            ? ['user_id' => auth()->id()]
            : ['session_id' => session()->getId()];

        $items = Basket::where($identifier)->get();

        return view('pages.basket', compact('items')); // adjust this line to match your file path
    }

    /**
     * Add a product to the basket.
     */
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        // Identify guest or logged-in user
        $identifier = auth()->check()
            ? ['user_id' => auth()->id()]
            : ['session_id' => session()->getId()];

        // Check if item already exists for this user/session
        $existing = Basket::where($identifier)
                        ->where('product_id', $product->id)
                        ->first();

        if ($existing) {
            $existing->quantity += 1;
            $existing->save();
        } else {
            Basket::create([
                'user_id'    => auth()->id(), // null for guests
                'session_id' => auth()->check() ? null : session()->getId(),
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'quantity'   => 1,
                'image'      => $product->image_url ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Added to basket!');
    }

    /**
     * Show checkout page with basket items.
     */
    public function checkout()
    {
        $identifier = auth()->check()
            ? ['user_id' => auth()->id()]
            : ['session_id' => session()->getId()];

        $items = Basket::where($identifier)->get();

        return view('pages.checkout.checkout', compact('items'));
    }

    /**
     * Update quantity of a basket item.
     */
    public function update(Request $request, $id)
    {
        $item = Basket::where('user_id', auth()->id())->findOrFail($id);
        $item->quantity = $request->quantity;
        $item->save();

        return redirect()->back();
    }

    /**
     * Remove a single item from basket.
     */
    public function destroy($id)
    {
        $item = Basket::where('user_id', auth()->id())->findOrFail($id);
        $item->delete();

        return redirect()->back();
    }

    /**
     * Clear the entire basket for this user.
     */
    public function clear()
    {
        Basket::where('user_id', auth()->id())->delete();
        return redirect()->back();
    }
}