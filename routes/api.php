<?php

use App\Http\Controllers\CryptoController;
use App\Http\Middleware\DevTesting;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(CryptoController::class)->group(function() {
    Route::get('/update-prices', 'updatePrices')->middleware(DevTesting::class); // Route for test
    Route::get('/coin/{id}/last-price', 'lastPrice');
    Route::get('/coin/{id}/price-by-datetime', 'pricesByDatetime');
    Route::get('/coin/list', 'coinList');
});
