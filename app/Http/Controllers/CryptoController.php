<?php

namespace App\Http\Controllers;

use App\Jobs\CoinGeckoJob;
use App\Models\Crypto;
use App\Services\PriceDateTimeService;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastPrice($id)
    {
        $priceDateTimeService = new PriceDateTimeService(now(), $id);

        return response()->json([
            'coin' => $priceDateTimeService->getCoin(),
            'price' => $priceDateTimeService->getPrice()
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param datetime $date
     * @return \Illuminate\Http\Response
     */
    public function pricesByDatetime(Request $request, $id)
    {
        $priceDateTimeService = new PriceDateTimeService($request->dateTime, 3);

        return response()->json([
            'coin' => $priceDateTimeService->getCoin(),
            'price' => $priceDateTimeService->getPrice()
        ], 200);
    }

    public function updatePrices()
    {
        CoinGeckoJob::dispatch();
    }

    public function coinList()
    {
        $coins = Crypto::all(['id', 'name']);

        return response()->json([
            'coins' => $coins
        ], 200);
    }
}

