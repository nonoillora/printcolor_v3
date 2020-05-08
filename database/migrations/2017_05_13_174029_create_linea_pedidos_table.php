<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineaPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linea_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idProduct')->unsigned()->nullable();
            $table->foreign('idProduct')->references('id')->on('productos')->onUpdate('cascade');
            $table->text('description');
            $table->float('price', 8, 2);
            $table->text('options');
            $table->text('session_id');
            $table->boolean('lineaPedido_is_active')->default(1);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('linea_pedidos');
    }
}
