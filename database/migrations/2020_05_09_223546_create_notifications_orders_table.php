<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_orders', function (Blueprint $table) {
            $table->bigIncrements('idNotificationOrder');
            $table->integer('idPedido')->unsigned();
            $table->enum('status',array('P','E','S','F'))->default('P')->comment('Estado de la notificacion, (P: Pending, E: Execution, S: Success, F: Failed)');
            $table->text('output')->nullable()->comment('Lo que devuelve el commando');
            $table->timestamp('executed_at')->nullable()->comment('Hora de inicio de ejecucion');
            $table->timestamp('success_at')->nullable()->comment('Hora de fin de ejecucion');
            $table->timestamp('failed_at')->nullable()->comment('Hora de fallo en la ejecucion');
            $table->boolean('notification_order_is_active')->default(1);
            $table->foreign('idPedido')->references('idPedido')->on('pedidos');
            $table->softDeletes();
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
        Schema::dropIfExists('notifications_orders');
    }
}
