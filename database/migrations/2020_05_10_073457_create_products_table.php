<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('barcode')->nullable();
            $table->unsignedInteger('abv');
            $table->text('image');
            $table->year('vintage')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('sale')->nullable();
            $table->unsignedInteger('instock');
            $table->boolean('bestseller')->default(0);

            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->unsignedInteger('size_id');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');

            $table->unsignedInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

            $table->unsignedInteger('subcate_id');
            $table->foreign('subcate_id')->references('id')->on('subcates')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
