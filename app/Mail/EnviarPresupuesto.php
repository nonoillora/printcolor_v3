<?php

namespace App\Mail;

use App\Presupuesto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarPresupuesto extends Mailable
{
    use Queueable, SerializesModels;

    public $presupuesto;
    public $producto;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Presupuesto $presupuesto, $producto)
    {
        $this->presupuesto = $presupuesto;
        $this->producto = $producto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notificationsMail.nuevoPresupuesto');
    }
}
