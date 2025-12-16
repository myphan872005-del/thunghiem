<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('Main-page');
});

Route::get('/getWard/{cityId}', [\App\Http\Controllers\LocationController::class, 'getWardsByCity']);
Route::get('/getCity', [\App\Http\Controllers\LocationController::class, 'getCity']);

Route::get('/properties', [SearchController::class, 'index'])
    ->name('properties.index');  