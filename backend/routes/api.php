<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/items', [ItemController::class, 'all']);
Route::post('/items', [ItemController::class, 'save']);

Route::get('/tenants', [TenantController::class, 'all']);
Route::get('/tenants/{id}', [TenantController::class, 'get']);
Route::post('/tenants', [TenantController::class, 'save']);

Route::get('/transactions', [TransactionController::class, 'all']);
Route::post('/transactions', [TransactionController::class, 'save']);

Route::get('/secret', [AuthController::class, 'getSecret']);
Route::get('/jwt-by-email', [AuthController::class, 'getJwtByEmail']);