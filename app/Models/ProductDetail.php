<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    public $timestamps = false;
    protected $table = 'product_detail';
    protected $fillable = [
        'brand',
        'country',
        'product_gtin'
    ];
}
