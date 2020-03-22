<?php

namespace App\Mail;

use App\CompanyShipping;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Pedido;
use App\Cliente;

class OrderSent extends Mailable
{
    use Queueable, SerializesModels;
    public $pedido;
    public $cliente;
    public $lineas;
    public $companyShipping;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pedido $pedido, Cliente $cliente, Collection $lineas, CompanyShipping $company)
    {
        $this->pedido = $pedido;
        $this->cliente = $cliente;
        $this->lineas = $lineas;
        $this->companyShipping = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notificationsMail.orderSent')->subject('Tu pedido ' . $this->pedido->idpedido . ' ha sido enviado');
    }
}
