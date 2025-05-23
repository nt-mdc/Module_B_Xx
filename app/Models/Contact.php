<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $table = 'contact';
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
