<?php

namespace App\Jobs;

use App\Models\Crypto;
use App\Models\CryptoPrice;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class CoinGeckoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();
        $request = new Request('GET', 'https://api.coingecko.com/api/v3/simple/price?vs_currencies=usd&ids=bitcoin,dacxi,ethereum,cosmos,terra-luna-2');
        $response = $client->sendAsync($request)->wait();

        $coins = json_decode($response->getBody());
        $coinsInsert = array();

        foreach ($coins as $key => $coin) {
            $coinId = Crypto::where('alias', $key)->get(['id'])->first();
            $now = \Carbon\Carbon::now();
            $coinsInsert[] = [
                'crypto_id' => $coinId->id,
                'price' => $coin->usd,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        CryptoPrice::insert($coinsInsert);
    }
}
