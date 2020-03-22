<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
    protected $fillable = [
        'id','idProduct','description', 'price', 'options','session_id'
    ];
    protected $table = 'linea_pedidos';
}
