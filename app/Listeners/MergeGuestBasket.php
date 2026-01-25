<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use App\Models\Basket;

class MergeGuestBasket
{
    public function handle(Authenticated $event)
    {
        $sessionId = session()->getId();
        $userId = $event->user->id;

        // Get guest basket items
        $guestItems = Basket::where('session_id', $sessionId)->get();

        if ($guestItems->isEmpty()) {
            return;
        }

        foreach ($guestItems as $guestItem) {

            // Check if user already has this product in basket
            $existing = Basket::where('user_id', $userId)
                ->where('product_id', $guestItem->product_id)
                ->first();

            if ($existing) {
                // Merge quantities
                $existing->quantity += $guestItem->quantity;
                $existing->save();

                // Remove guest item
                $guestItem->delete();
            } else {
                // Convert guest item to user item
                $guestItem->update([
                    'user_id' => $userId,
                    'session_id' => null
                ]);
            }
        }
    }
}