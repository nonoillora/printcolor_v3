<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $primaryKey = 'idPedido';

    protected $table = 'pedidos';

    protected $fillable = [
        'idPedido', 'idCliente', 'idLineas', 'idTipoPago', 'totalPedido', 'isSent', 'isPaid', 'num_seguimiento', 'company_shipping', 'numIdentificacionPedido', 'totalIVA', 'withoutIVA'];

    public function tipoPago()
    {
        return $this->hasMany(\App\TipoPago::class, 'id','idTipoPago');
    }

    public function cliente()
    {
        return $this->hasMany(\App\Cliente::class, 'id','idCliente')->first();
    }

    public function factura()
    {
        return $this->hasOne(\App\Factura::class, 'idPedido','idPedido')->first();
    }

}
