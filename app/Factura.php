<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $primaryKey = 'idFactura';

    protected $table = "facturas";

    protected $fillable = [
        'idFactura','idPedido','numeracionFactura'];

    public function pedido(){
        return $this->belongsTo(\App\Pedido::class,'idPedido','idPedido');
    }
}
