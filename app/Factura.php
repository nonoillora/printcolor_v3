<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $primaryKey = 'idFactura';

    protected $fillable = [
        'idPedido','numeracionFactura'];
}
