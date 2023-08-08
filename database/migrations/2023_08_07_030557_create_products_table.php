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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('price')->nullable();
            $table->text('content')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('active')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->rememberToken();
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
};
