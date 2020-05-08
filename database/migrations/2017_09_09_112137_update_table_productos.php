<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->boolean('product_is_active')->default(1)->after('description');
            $table->integer('deleted_by_user_id')->unsigned()->nullable()->after('product_is_active');
            $table->foreign('deleted_by_user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->timestamp('deleted_at')->nullable()->after('deleted_by_user_id');
            $table->integer('idCategoria')->unsigned()->nullable()->change();
            $table->foreign('idCategoria')->references('id')->on('categories')->onDelete('SET NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
