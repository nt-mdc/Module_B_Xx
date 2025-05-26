<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $table = 'contact';
    protected $fillable = [
        'contact_name',
        'contact_number',
        'contact_email',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(company::class);
    }
}
