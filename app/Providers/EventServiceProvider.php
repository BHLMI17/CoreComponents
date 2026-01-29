<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Authenticated;
use App\Listeners\MergeGuestBasket;
use Illuminate\Auth\Events\Login;

class EventServiceProvider extends ServiceProvider
{
protected $listen = [
    Login::class => [
        MergeGuestBasket::class,
    ],
];
}