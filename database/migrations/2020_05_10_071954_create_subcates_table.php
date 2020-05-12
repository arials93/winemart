<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('image')->nullable();

            $table->unsignedInteger('cate_id');
            $table->foreign('cate_id')->references('id')->on('cates')->onDelete('cascade');
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
        Schema::dropIfExists('subcates');
    }
}
