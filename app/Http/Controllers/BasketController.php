<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Basket;

class BasketController extends Controller
{
    /**
     * Display all basket items.
     */
    public function index()
{
    $items = Basket::all();
    return response()->json($items);
}

    /**
     * Add a product to the basket.
     */
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        // Check if product already exists in basket
        $existing = Basket::where('product_id', $product->id)->first();

        if ($existing) {
            $existing->quantity += 1;
            $existing->save();
        } else {
            Basket::create([
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
     * Update quantity of a basket item.
     */
    public function update(Request $request, $id)
    {
        $item = Basket::findOrFail($id);
        $item->quantity = $request->quantity;
        $item->save();

        return response()->json($item);
    }

    /**
     * Remove a single item from basket.
     */
    public function destroy($id)
    {
        $item = Basket::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item removed']);
    }

    /**
     * Clear the entire basket.
     */
    public function clear()
    {
        Basket::truncate();
        return response()->json(['message' => 'Basket cleared']);
    }
}