<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasketController;

Route::get('/basket', [BasketController::class, 'index']);
Route::post('/basket/add/{productId}', [BasketController::class, 'store']);
Route::put('/basket/update/{id}', [BasketController::class, 'update']);
Route::delete('/basket/remove/{id}', [BasketController::class, 'destroy']);
Route::delete('/basket/clear', [BasketController::class, 'clear']);
