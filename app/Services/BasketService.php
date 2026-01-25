<?php

namespace App\Services;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BasketService
{
    protected function identifier()
    {
        return Auth::check()
            ? ['user_id' => Auth::id()]
            : ['session_id' => session()->getId()];
    }

    public function addItem($productId, $qty = 1)
    {
        $product = Product::findOrFail($productId);

        // Stock validation
        if ($product->stock < 1) {
            throw new \Exception('Product out of stock');
        }

        $identifier = $this->identifier();

        $item = Basket::where($identifier)
            ->where('product_id', $productId)
            ->first();

        if ($item) {
            // Increase quantity
            $newQty = $item->quantity + $qty;

            if ($newQty > $product->stock) {
                throw new \Exception('Not enough stock');
            }

            $item->quantity = $newQty;
            $item->save();
        } else {
            // Create new basket item
            Basket::create([
                'user_id'    => Auth::id(),
                'session_id' => Auth::check() ? null : session()->getId(),
                'product_id' => $productId,
                'quantity'   => $qty,
            ]);
        }
    }

    public function updateQuantity($itemId, $qty)
    {
        $item = Basket::where($this->identifier())->findOrFail($itemId);

        if ($qty < 1) {
            $item->delete();
            return;
        }

        if ($qty > $item->product->stock) {
            throw new \Exception('Not enough stock');
        }

        $item->quantity = $qty;
        $item->save();
    }

    public function removeItem($itemId)
    {
        $item = Basket::where($this->identifier())->findOrFail($itemId);
        $item->delete();
    }

    public function clear()
    {
        Basket::where($this->identifier())->delete();
    }

    public function getItems()
    {
        return Basket::where($this->identifier())
            ->with('product')
            ->get();
    }

    public function getTotal()
    {
        return $this->getItems()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }

    public function mergeGuestBasket()
    {
        if (!Auth::check()) return;

        $sessionId = session()->getId();
        $userId = Auth::id();

        $guestItems = Basket::where('session_id', $sessionId)->get();

        foreach ($guestItems as $guestItem) {

            $existing = Basket::where('user_id', $userId)
                ->where('product_id', $guestItem->product_id)
                ->first();

            if ($existing) {
                $existing->quantity += $guestItem->quantity;
                $existing->save();
                $guestItem->delete();
            } else {
                $guestItem->update([
                    'user_id' => $userId,
                    'session_id' => null
                ]);
            }
        }
    }
}