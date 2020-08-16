<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComboDishSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_dish_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('combo_dish_categories_id')->nullable()->references('id')->on('combo_dish_categories')->onDelete('cascade');
            $table->foreignId('dish_id')->nullable()->references('id')->on('dishes')->onDelete('cascade');
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
        Schema::dropIfExists('combo_dish_subcategories');
    }
}
