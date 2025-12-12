<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('Main-page');
});

//Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/search', [SearchController::class, 'search'])->name('search');
//});    