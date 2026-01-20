<?php

namespace App\Services;

use app\Models\Basket;
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
        $id = $this->identifier();

        Basket::updateOrCreate(
            array_merge($id, ['product_id' => $productId]),
            ['quantity' => \DB::raw('quantity + ' . $qty)]
        );
    }

    public function getItems()
    {
        return Basket::where($this->identifier())->with('product')->get();
    }

    public function mergeGuestBasket()
    {
        if (!Auth::check()) return;

        Basket::where('session_id', session()->getId())
            ->update([
                'user_id' => Auth::id(),
                'session_id' => null
            ]);
    }
}