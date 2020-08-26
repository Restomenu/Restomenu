<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->nullable()->references('id')->on('restaurants')->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('number_of_people')->nullable();
            $table->string('phone')->nullable();
            $table->enum('is_terms_checked', ['0', '1']);
            $table->string('appointment_time')->nullable();
            $table->enum('is_agreed', ['0', '1'])->default(0);
            $table->tinyInteger('appointment_status')->default(0)->comment('-1: reject ,0: pending, 1:accept');
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
        Schema::dropIfExists('reservations');
    }
}
