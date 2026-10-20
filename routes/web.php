<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\RentalsController;

Route::get('/', function () {
    return redirect()->route('cars.index');
});

Route::resource('cars', CarsController::class);
Route::resource('rentals', RentalsController::class);
