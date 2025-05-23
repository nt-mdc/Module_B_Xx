<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductWeight extends Model
{
    public $timestamps = false;
    protected $table = 'product_weight';
    protected $fillable = [
        'unit',
        'gross',
        'net',
        'product_gtin'
    ];
}
