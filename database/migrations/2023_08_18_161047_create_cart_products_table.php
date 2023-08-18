<?php

use App\Models\Product;
use App\Models\User;
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
        Schema::create('cart_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_size');
            $table->string('product_color');
            $table->smallInteger('product_quantity');
            $table->double('product_price');
            
            // Cột khóa ngoại product_id liên kết với bảng products
            $table->unsignedInteger('product_id')->constrained('products')->cascadeOnDelete();
            
            // Cột khóa ngoại user_id liên kết với bảng users (nếu bạn có bảng users)
            $table->unsignedInteger('user_id')->constrained('users')->cascadeOnDelete();
            
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
        Schema::dropIfExists('cart_products');
    }
};
