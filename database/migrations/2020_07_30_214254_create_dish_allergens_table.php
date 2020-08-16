<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishAllergensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_allergens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('allergen_id')->nullable()->references('id')->on('allergens')->onDelete('cascade');
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
        Schema::dropIfExists('dish_allergens');
    }
}
