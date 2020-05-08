<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypePriceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_price_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idProduct')->unsigned();
            $table->foreign('idProduct')->references('id')->on('productos');
            $table->string('nameTypePrice');
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
        Schema::dropIfExists('type_price_products');
    }
}
