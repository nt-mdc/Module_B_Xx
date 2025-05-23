<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public $timestamps = false;
    protected $table = 'owner';
    protected $fillable = [
        'name',
        'number',
        'email',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(company::class);
    }
}