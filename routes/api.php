<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\ExportUserController;
use App\Http\Controllers\ImportUserController;


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

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('flights', FlightController::class);

});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->middleware('web');
Route::get('/flights/{flight}/passengers', [PassengerController::class, 'index'])->middleware('auth:sanctum' , 'secure.headers');
Route::get('/export-users', [ExportUserController::class, 'export'])->middleware('auth:sanctum');
Route::post('/users/import', [ImportUserController::class, 'import'])->middleware('auth:sanctum');
Route::post('/passenger-image/store', [PassengerController::class, 'storeImage'])->middleware('auth:sanctum');
