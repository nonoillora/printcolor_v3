<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pedido;

class TipoPago extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'tipo_pagos';

    protected $fillable = [
        'id','nombre'
    ];
}
