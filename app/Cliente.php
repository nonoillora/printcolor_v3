<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['full_name',
        'enterprise',
        'phone',
        'nif_cif',
        'address',
        'poblation',
        'postal_code',
        'provence',
        'email',
        'observations',
        'session_id'
    ];
}
