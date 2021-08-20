<?php

use App\Http\Controllers\FlightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/flights', [FlightController::class, 'find']);
