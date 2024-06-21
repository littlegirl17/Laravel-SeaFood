<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\HomeController;

Route::prefix('v1')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('api.home.index');
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');