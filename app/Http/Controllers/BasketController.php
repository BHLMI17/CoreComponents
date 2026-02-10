<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Basket;

class BasketController extends Controller
{
    private function identifier()
    {
        return auth()->check()
            ? ['user_id' => auth()->id()]
            : ['session_id' => session()->getId()];
    }

    private function getBasketItems()
    {
        return Basket::where($this->identifier())
            ->with('product') // Eager load product details
            ->get();
    }

    public function index()
    {
        $items = $this->getBasketItems();
        return view('pages.basket', compact('items'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);
        $identifier = $this->identifier();

        $existing = Basket::where($identifier)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->quantity += 1;
            $existing->save();
        } else {
            Basket::create([
                'user_id'    => auth()->id(),
                'session_id' => auth()->check() ? null : session()->getId(),
                'product_id' => $product->id,
                'quantity'   => 1,
            ]);
        }

        return back()->with('success', 'Added to basket!');
    }

    public function checkout()
    {
        $items = $this->getBasketItems();
        return view('pages.checkout.checkout', compact('items'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $item = Basket::where($this->identifier())
        ->with('product')
        ->findOrFail($id);

    $item->quantity = $request->quantity;
    $item->save();

    return response()->json(['success' => true]);
}

    public function destroy($id)
    {
        // Securely delete only the item that belongs to this user/session
        $item = Basket::where($this->identifier())
            ->whereKey($id)
            ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        Basket::where($this->identifier())->delete();
        return back()->with('success', 'Basket cleared.');
    }
}
