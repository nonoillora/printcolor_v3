<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTablePresupuestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuestos', function (Blueprint $table) {
            $table->boolean('budget_is_active')->default(1)->after('idProducto');
            $table->timestamp('deleted_at')->nullable()->after('budget_is_active');
            $table->integer('deleted_by_user_id')->unsigned()->nullable()->after('deleted_at');
            $table->foreign('deleted_by_user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presupuestos');

    }
}
