<?php

namespace App\Services;

use App\Models\Crypto;
use App\Models\CryptoPrice;

class PriceDateTimeService
{

    public function __construct($dateTime, $cryptoId)
    {
        $this->dateTime = $dateTime;
        $this->cryptoId = $cryptoId;
    }

    public function getCoin()
    {
        $coin = Crypto::findOrFail($this->cryptoId);

        return $coin->only('name', 'image', 'symbol'); // return only visual column to front end
    }

    public function getPrice()
    {
        $price = CryptoPrice::limit(1)
                            ->select('price', 'created_at')
                            ->selectRaw('TO_CHAR(created_at, \'YYYY/MM/DD HH24:MI:SS\') as price_date')
                            ->where('crypto_id', $this->cryptoId)
                            ->where('created_at', '>=', $this->dateTime)
                            ->orderBy('id', 'asc')
                            ->get()
                            ->first();

        if ($price === null) { // if there is no price at datetime, get the last price after that datetime
            $price = CryptoPrice::limit(1)
                        ->select('price', 'created_at')
                        ->selectRaw('TO_CHAR(created_at, \'YYYY/MM/DD HH24:MI:SS\') as price_date')
                        ->where('crypto_id', $this->cryptoId)
                        ->where('created_at', '<', $this->dateTime)
                        ->orderBy('id', 'desc')
                        ->get()
                        ->first();
        }

        return $price;
    }
}
