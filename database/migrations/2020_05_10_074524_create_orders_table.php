<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('delivery_date')->nullable();
            $table->date('receiving_date')->nullable();
            $table->unsignedInteger('total');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone', 10)->nullable();
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('comfirm')->default(0);

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
