<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTablePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->integer('company_shipping')->unsigned()->nullable()->foreign('company_shipping')->references('idCompany')->on('company_shipppings')->onUpdate('cascade')->change();
            $table->text('numIdentificacionPedido')->nullable()->after('company_shipping');
            $table->timestamp('picked_up_at')->nullable()->after('numIdentificacionPedido');
            $table->timestamp('sent_at')->nullable()->after('picked_up_at');
            $table->timestamp('paid_at')->nullable()->after('sent_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
