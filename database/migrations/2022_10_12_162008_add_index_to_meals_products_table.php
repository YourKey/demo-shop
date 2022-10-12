<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToMealsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meal_product', function (Blueprint $table) {
            $table->foreign('meal_id')
                ->references('id')
                ->on('meals');
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meal_product', function (Blueprint $table) {
            $table->dropForeign(['meal_product_meal_id_foreign', 'meal_product_product_id_foreign']);
        });
    }
}
