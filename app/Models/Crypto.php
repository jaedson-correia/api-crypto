<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    protected $table = 'cryptos';

    protected $fillable = [
        'name',
        'image',
        'symbol',
        'alias'
    ];

    public function prices()
    {
        return $this->hasMany(CryptoPrice::class);
    }
}
