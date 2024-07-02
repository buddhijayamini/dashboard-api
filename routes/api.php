<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'hi';
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/dashboard', [DashboardController::class, 'receiveData']);
Route::get('/dashboard', [DashboardController::class, 'fetchData']);
