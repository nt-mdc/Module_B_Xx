<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = 'products';
    protected $primaryKey = 'gtin';
    protected $fillable = [
        'gtin',
        'hidden',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function detail()
    {
        return $this->hasOne(ProductDetail::class, 'product_gtin', 'gtin');
    }

    public function weight()
    {
        return $this->hasOne(ProductWeight::class, 'product_gtin', 'gtin');
    }

    public function image()
    {
        return $this->hasOne(ProductImage::class, 'product_gtin', 'gtin');
    }


    public function translations()
    {
        return $this->hasMany(ProductTranslation::class, 'product_gtin', 'gtin');
    }
}
