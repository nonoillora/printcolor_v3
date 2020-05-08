<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('idPedido');
            $table->integer('idCliente')->unsigned();
            $table->foreign('idCliente')->references('id')->on('clientes');
            $table->text('idLineas');
            $table->integer('idTipoPago')->unsigned();
            $table->foreign('idTipoPago')->references('id')->on('tipo_pagos');
            $table->float('totalPedido');
            $table->boolean('isSent');
            $table->boolean('isPaid');
            $table->text('num_seguimiento');
            $table->string('company_shipping');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
