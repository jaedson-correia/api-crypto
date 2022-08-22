<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoPrice extends Model
{
    protected $table = 'crypto_prices';

    protected $fillable = [
        'crypto_id',
        'price'
    ];

    public function crypto()
    {
        return $this->belongsTo(Crypto::class);
    }
}
