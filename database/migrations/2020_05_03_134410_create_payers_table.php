<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payers', function (Blueprint $table) {
            $table->bigIncrements('idPayer');
            $table->integer('idPedido')->unsigned();
            $table->string('PayerID');
            $table->string('statusTransaction')->comment('estado de la transaccion, nos lo devuelve el propio paypal');
            $table->string('pendingReason')->comment('estado de la transaccion, nos lo devuelve el propio paypal');
            $table->string('reasonCode')->comment('estado de la transaccion, nos lo devuelve el propio paypal');
            $table->double('amountPay',2)->comment('Cantidad paga en paypal');
            $table->string('browser')->comment('Navegador usado')->nullable();
            $table->string('version_browser')->comment('Version navegador usado')->nullable();
            $table->string('deviceFamily')->comment('Familia dispositivo usado')->nullable();
            $table->string('deviceModel')->comment('Modelo del dispositivo usado')->nullable();
            $table->string('platform')->comment('plataforma usado')->nullable();
            $table->foreign('idPedido')->references('idPedido')->on('pedidos');
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
        Schema::dropIfExists('payers');
    }
}
