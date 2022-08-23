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

        return $coin->only('name', 'image', 'symbol'); // return only necessary column to front end
    }

    public function getPrice()
    {
        $price = CryptoPrice::where('crypto_id', $this->cryptoId)
                            ->where('created_at', $this->dateTime)
                            ->get(['price', 'created_at'])
                            ->first();

        if ($price === null) { // if there is no price at datetime, get the last price before that datetime
            $price = CryptoPrice::limit(1)
                        ->where('crypto_id', $this->cryptoId)
                        ->where('created_at', '<', $this->dateTime)
                        ->orderBy('id', 'desc')
                        ->get(['price', 'created_at'])
                        ->first();
        }

        return $price;
    }
}
