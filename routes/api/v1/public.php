<?php

use Illuminate\Support\Facades\Route;
use App\Core\v1\Public\Controllers\TourController;

Route::get('tours', [TourController::class, 'index']);
