<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        
            $table->unsignedInteger('attribute_id')->nullable();
            $table->foreign('attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
        });
        
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_attribute_id');
            $table->string('value');
            $table->integer('quantity');
            $table->timestamps();
        
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
};
