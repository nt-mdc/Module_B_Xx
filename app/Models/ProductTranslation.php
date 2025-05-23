<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'product_translation';
    protected $fillable = [
        'language',
        'name',
        'description',
        'product_gtin'
    ];
}
