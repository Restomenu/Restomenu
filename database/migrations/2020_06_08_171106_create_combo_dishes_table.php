<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComboDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_dutch')->nullable();
            $table->string('name_french')->nullable();

            $table->longText('description')->nullable();
            $table->longText('description_dutch')->nullable();
            $table->longText('description_french')->nullable();

            $table->string('price')->nullable();

            $table->string('image')->nullable();
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
        Schema::dropIfExists('combo_dishes');
    }
}
