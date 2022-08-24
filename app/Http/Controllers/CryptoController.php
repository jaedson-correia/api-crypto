<?php

namespace App\Http\Controllers;

use App\Events\NewPrice;
use App\Jobs\CoinGeckoJob;
use App\Models\Crypto;
use App\Services\PriceDateTimeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    /**
     * Return coin last price.
     *
     * @param  int  $id
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
     * Return coin price by datetime.
     *
     * @param  int  $id
     * @param request $request
     * @return \Illuminate\Http\Response
     */
    public function pricesByDatetime(Request $request, $id)
    {
        $date = Carbon::parse($request->dateTime);
        $priceDateTimeService = new PriceDateTimeService($date, $id);

        return response()->json([
            'coin' => $priceDateTimeService->getCoin(),
            'price' => $priceDateTimeService->getPrice()
        ], 200);
    }

    public function updatePrices()
    {
        CoinGeckoJob::dispatch();
    }

    /**
     * Return coin price by datetime.
     *
     * @return \Illuminate\Http\Response
     */
    public function coinList()
    {
        $coins = Crypto::all(['id', 'name']);

        return response()->json([
            'coins' => $coins
        ], 200);
    }
}

