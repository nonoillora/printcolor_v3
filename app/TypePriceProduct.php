<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypePriceProduct extends Model
{
    protected $fillable = [
        'idProduct', 'nameTypePrice'
    ];
}
