<?php

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ImportController;
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

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('flights', FlightController::class);

});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:uploads');
Route::get('/flights/{flight}/passengers', [PassengerController::class, 'index']);

Route::get('/export-users', [UserController::class, 'export']);

Route::post('/import', [ImportController::class, 'import']);
Route::post('/photos', [PassengerController::class, 'storeImage']);
