<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public $timestamps = false;
    protected $table = 'product_image';
    protected $fillable = [
        'image_path',
        'product_gtin'
    ];
}
