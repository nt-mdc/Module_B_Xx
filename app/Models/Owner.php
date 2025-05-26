<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public $timestamps = false;
    protected $table = 'owner';
    protected $fillable = [
        'owner_name',
        'owner_number',
        'owner_email',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(company::class);
    }
}