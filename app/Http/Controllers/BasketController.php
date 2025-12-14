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
        $items = Basket::where('user_id', auth()->id())->get();
        return view('pages.basket.index', compact('items'));
    }

    /**
     * Add a product to the basket.
     */
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $existing = Basket::where('user_id', auth()->id())
                          ->where('product_id', $product->id)
                          ->first();

        if ($existing) {
            $existing->quantity += 1;
            $existing->save();
        } else {
            Basket::create([
                'user_id'    => auth()->id(),
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
        $items = Basket::where('user_id', auth()->id())->get();
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