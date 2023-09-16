<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/customers', [\App\Http\Controllers\CustomerController::class, 'store'])->name('customer-api.store');
Route::get('/customers/{id}', [\App\Http\Controllers\CustomerController::class, 'view'])->name('customer-api.view');
Route::put('/customers/{id}', [\App\Http\Controllers\CustomerController::class, 'update'])->name('customer-api.update');
Route::delete('/customers/{id}', [\App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer-api.delete');
