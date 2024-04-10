<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\Frontend\QuoteController;
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
Route::middleware('throttle:60,1')->prefix('v1')->group(function () {
    Route::post('/endpoint', [ContactFormController::class, 'submit']);
    Route::get('/successfulPayment', [QuoteController::class, 'successfulPayment']);
});
