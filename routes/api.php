<?php

use App\Http\Controllers\CryptoController;
use App\Http\Middleware\DevTesting;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
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

Route::get('/teste', function() {
    $client = new Client();
    $request = new Request('GET', 'https://api.coingecko.com/api/v3/coins/bitcoin');
    $res = $client->sendAsync($request)->wait();
    return json_decode($res->getBody());
});

Route::controller(CryptoController::class)->group(function() {
    Route::get('/update-prices', 'updatePrices')->middleware(DevTesting::class);
    Route::get('/coin/{id}/last-price', 'lastPrice')->middleware('throttle:20,1');
    Route::get('/coin/{id}/price-by-datetime', 'pricesByDatetime')->middleware('throttle:20,1');
    Route::get('/coin/list', 'coinList')->middleware('throttle:20,1');
});
