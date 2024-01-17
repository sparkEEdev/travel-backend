<?php

use App\Core\v1\Dashboard\Controllers\TourController;
use App\Core\v1\Dashboard\Controllers\TravelController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'dashboard',
    'middleware' => 'role:admin,editor',
], function () {

    Route::get('travels', [TravelController::class, 'index']);
    Route::post('travels', [TravelController::class, 'store'])->middleware('role:admin');
    Route::get('travels/{id}', [TravelController::class, 'show']);
    Route::patch('travels/{id}', [TravelController::class, 'update']);
    Route::post('travels/{id}/publish', [TravelController::class, 'publish']);

    Route::post('tours', [TourController::class, 'store'])
        ->middleware('role:admin');
});

