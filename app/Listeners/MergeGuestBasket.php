<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use App\Models\Basket;

class MergeGuestBasket
{
    public function handle(Authenticated $event)
    {
        // The guest session ID before login
        $oldSessionId = session('guest_session_id');

        // The logged-in user's ID
        $userId = $event->user->getAuthIdentifier();

        if ($oldSessionId) {
            Basket::where('session_id', $oldSessionId)
                ->update([
                    'user_id' => $userId,
                    'session_id' => null
                ]);
        }
    }
}