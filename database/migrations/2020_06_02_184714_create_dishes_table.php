<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('name_dutch')->nullable();
            $table->string('name_french')->nullable();
            $table->string('price')->nullable();
            $table->string('description')->nullable();
            $table->string('description_dutch')->nullable();
            $table->string('description_french')->nullable();
            $table->string('image')->nullable();
            $table->string('state')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0: inactive, 1:active');
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
        Schema::dropIfExists('dishes');
    }
}
