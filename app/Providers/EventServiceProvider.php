<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Authenticated;
use App\Listeners\MergeGuestBasket;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Authenticated::class => [
            MergeGuestBasket::class,
        ],
    ];
}