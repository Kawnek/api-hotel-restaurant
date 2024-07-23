<?php

use App\Http\Controllers\DiningTableController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('orders', OrderController::class);
Route::apiResource('dining-tables', DiningTableController::class);
Route::apiResource('menu-items', MenuItemController::class);
