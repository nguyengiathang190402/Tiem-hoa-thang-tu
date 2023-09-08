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
        Schema::table('product_product_attribute', function (Blueprint $table) {
            $table->unsignedInteger('attribute_value_id')->after('product_attribute_id')->nullable();
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_product_attribute', function (Blueprint $table) {
            $table->dropForeign(['attribute_value_id']);
            $table->dropColumn('attribute_value_id');
        });
    }
};
