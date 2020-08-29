<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_time', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->nullable()->references('id')->on('restaurants')->onDelete('cascade');

            $table->tinyInteger('monday')->nullable();
            $table->string('monday_mrng_start_time')->nullable();
            $table->string('monday_mrng_ending_time')->nullable();
            $table->string('monday_evng_start_time')->nullable();
            $table->string('monday_evng_ending_time')->nullable();

            $table->tinyInteger('tuesday')->nullable();
            $table->string('tuesday_mrng_start_time')->nullable();
            $table->string('tuesday_mrng_ending_time')->nullable();
            $table->string('tuesday_evng_start_time')->nullable();
            $table->string('tuesday_evng_ending_time')->nullable();

            $table->tinyInteger('wednesday')->nullable();
            $table->string('wednesday_mrng_start_time')->nullable();
            $table->string('wednesday_mrng_ending_time')->nullable();
            $table->string('wednesday_evng_start_time')->nullable();
            $table->string('wednesday_evng_ending_time')->nullable();

            $table->tinyInteger('thursday')->nullable();
            $table->string('thursday_mrng_start_time')->nullable();
            $table->string('thursday_mrng_ending_time')->nullable();
            $table->string('thursday_evng_start_time')->nullable();
            $table->string('thursday_evng_ending_time')->nullable();

            $table->tinyInteger('friday')->nullable();
            $table->string('friday_mrng_start_time')->nullable();
            $table->string('friday_mrng_ending_time')->nullable();
            $table->string('friday_evng_start_time')->nullable();
            $table->string('friday_evng_ending_time')->nullable();

            $table->tinyInteger('saturday')->nullable();
            $table->string('saturday_mrng_start_time')->nullable();
            $table->string('saturday_mrng_ending_time')->nullable();
            $table->string('saturday_evng_start_time')->nullable();
            $table->string('saturday_evng_ending_time')->nullable();

            $table->tinyInteger('sunday')->nullable();
            $table->string('sunday_mrng_start_time')->nullable();
            $table->string('sunday_mrng_ending_time')->nullable();
            $table->string('sunday_evng_start_time')->nullable();
            $table->string('sunday_evng_ending_time')->nullable();

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
        Schema::dropIfExists('restaurant_time');
    }
}
