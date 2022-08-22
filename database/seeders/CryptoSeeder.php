<?php

namespace Database\Seeders;

use App\Models\Crypto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CryptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Crypto::create([
            'name' => 'Bitcoin',
            'image' => 'https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1547033579',
            'symbol' => 'btc',
            'alias' => 'bitcoin',
        ]);

        Crypto::create([
            'name' => 'Dacxi',
            'image' => 'https://assets.coingecko.com/coins/images/4466/large/dacxi.png?1639042471',
            'symbol' => 'dacxi',
            'alias' => 'dacxi',
        ]);

        Crypto::create([
            'name' => 'Ethereum',
            'image' => 'https://assets.coingecko.com/coins/images/279/large/ethereum.png?1595348880',
            'symbol' => 'eth',
            'alias' => 'ethereum',
        ]);

        Crypto::create([
            'name' => 'Cosmos Hub',
            'image' => 'https://assets.coingecko.com/coins/images/1481/large/cosmos_hub.png?1555657960',
            'symbol' => 'atom',
            'alias' => 'cosmos',
        ]);

        Crypto::create([
            'name' => 'Terra',
            'image' => 'https://assets.coingecko.com/coins/images/25767/large/01_Luna_color.png?1653556122',
            'symbol' => 'luna',
            'alias' => 'terra-luna-2',
        ]);
    }
}
