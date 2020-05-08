<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCompanyShippings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_shippings', function (Blueprint $table) {
            $table->increments('idCompany');
            $table->string('name_company');
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->integer('totalShipping')->default(0);
            $table->text('url_company')->nullable();
            $table->text('url_follow_package')->nullable();
            $table->boolean('company_is_active')->default(1);
            $table->timestamp('company_shipping_deleted_at')->nullable();
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
        Schema::drop('company_shippings');
    }
}
