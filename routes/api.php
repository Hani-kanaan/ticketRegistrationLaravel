<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PassengerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/{flight}/passengers', [PassengerController::class, 'index']);
Route::post('/flights/create', [FlightController::class, 'create']);
Route::get('/flights/show/{flight}', [FlightController::class, 'show']);
Route::get('/flights/destroy/{flight}', [FlightController::class, 'destroy']);
Route::post('/flights/update/{flight}', [FlightController::class, 'update']);
