<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Basket;

class BasketController extends Controller
{
    /**
     * Display all basket items for the authenticated user.
     */
    public function index()
    {
        $userId = auth()->id();
        $items = Basket::where('user_id', $userId)->get();
        return response()->json($items);
    }

    /**
     * Add a product to the basket.
     */
    public function add(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->input('product_id');
        
        if (!$productId) {
            return response()->json(['error' => 'Product ID required'], 400);
        }
        
        $product = Product::findOrFail($productId);
        $existing = Basket::where('user_id', $userId)->where('product_id', $product->id)->first();

        if ($existing) {
            $existing->quantity += 1;
            $existing->save();
        } else {
            Basket::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image_url ?? null,
            ]);
        }

        $items = Basket::where('user_id', $userId)->get();
        return response()->json($items);
    }

    /**
     * Update quantity of a basket item.
     */
    public function update(Request $request, $id)
    {
        $userId = auth()->id();
        $item = Basket::where('id', $id)->where('user_id', $userId)->firstOrFail();
        $item->quantity = $request->quantity;
        $item->save();
        return response()->json($item);
    }

    /**
     * Remove a single item from basket.
     */
    public function destroy($id)
    {
        $userId = auth()->id();
        $item = Basket::where('id', $id)->where('user_id', $userId)->firstOrFail();
        $item->delete();
        $items = Basket::where('user_id', $userId)->get();
        return response()->json($items);
    }

    /**
     * Clear the entire basket for the current user.
     */
    public function clear()
    {
        $userId = auth()->id();
        Basket::where('user_id', $userId)->delete();
        return response()->json(['message' => 'Basket cleared']);
    }
}