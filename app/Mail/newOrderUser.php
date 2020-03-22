<?php

namespace App\Mail;

use App\Cliente;
use App\SupportFunctions\Helper;
use Illuminate\Support\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Pedido;
use App\Factura;


class newOrderUser extends Mailable
{
    use Queueable, SerializesModels;
    public $pedido;
    public $cliente;
    public $lineas;
    public $factura;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pedido $pedido,Cliente $cliente, Collection $lineas,Factura $factura)
    {
        $this->pedido = $pedido;
        $this->cliente = $cliente;
        $this->lineas = $lineas;
        $this->factura = $factura;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notificationsMail.newOrderUser')->subject('Nuevo pedido')
        ->attachData(Helper::doBillPDF('download',$this->pedido->idPedido),$this->pedido->numIdentificacionPedido.'.pdf', [
            'mime' => 'application/pdf']);;
    }
}
