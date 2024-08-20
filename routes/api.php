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


Route::resource('users', UserController::class);
Route::resource('flights', FlightController::class);
Route::get('/flights/{flight}/passengers', [PassengerController::class, 'index']);

// Route::get('/users', [UserController::class, 'index']);
// Route::get('/flights', [FlightController::class, 'index']);
// Route::get('/flights/{flight}/passengers', [PassengerController::class, 'index']);
// Route::post('/flights', [FlightController::class, 'store']);
// Route::get('/flights/show/{flight}', [FlightController::class, 'show']);
// Route::delete('/flights/{flight}', [FlightController::class, 'destroy']);
// Route::put('/flights/{flight}', [FlightController::class, 'update']);

// Route::get('/users/{user}', [UserController::class, 'show']);
// Route::post('/users', [UserController::class, 'store']);
// Route::delete('/users/{user}', [UserController::class, 'destroy']);
// Route::put('/users/{user}', [UserController::class, 'update']);