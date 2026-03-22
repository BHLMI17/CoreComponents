<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Basket;
use App\Support\DatabaseAvailability;

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
        $data = DatabaseAvailability::fallback(fn () => [
            'items' => $this->getBasketItems(),
            'databaseWarning' => null,
        ], [
            'items' => collect(),
            'databaseWarning' => DatabaseAvailability::warningMessage(),
        ]);

        return view('pages.basket', $data);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        return DatabaseAvailability::fallback(function () use ($request) {
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
                    'user_id' => auth()->id(),
                    'session_id' => auth()->check() ? null : session()->getId(),
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => 1,
                ]);
            }

            return back()->with('success', 'Added to basket!');
        }, fn () => back()->with('error', DatabaseAvailability::warningMessage()));
    }

    public function checkout()
    {
        $data = DatabaseAvailability::fallback(fn () => [
            'items' => $this->getBasketItems(),
            'databaseWarning' => null,
        ], [
            'items' => collect(),
            'databaseWarning' => DatabaseAvailability::warningMessage(),
        ]);

        return view('pages.checkout.checkout', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        return DatabaseAvailability::fallback(function () use ($request, $id) {
            $item = Basket::where($this->identifier())
                ->with('product')
                ->findOrFail($id);

            $item->quantity = $request->quantity;
            $item->save();

            return response()->json(['success' => true]);
        }, fn () => response()->json([
            'success' => false,
            'message' => DatabaseAvailability::warningMessage(),
        ], 503));
    }

    public function destroy($id)
    {
        return DatabaseAvailability::fallback(function () use ($id) {
            $item = Basket::where($this->identifier())
                ->whereKey($id)
                ->firstOrFail();

            $item->delete();

            return back()->with('success', 'Item removed from cart.');
        }, fn () => back()->with('error', DatabaseAvailability::warningMessage()));
    }

    public function clear()
    {
        return DatabaseAvailability::fallback(function () {
            Basket::where($this->identifier())->delete();

            return back()->with('success', 'Basket cleared.');
        }, fn () => back()->with('error', DatabaseAvailability::warningMessage()));
    }
}
