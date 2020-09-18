<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->nullable()->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreignId('reservation_id')->nullable()->references('id')->on('reservations')->onDelete('cascade');
            $table->string('notifcation_type')->nullable();
            $table->longText('notification_data')->nullable();
            $table->enum('is_viewed', ['0', '1']);
            $table->enum('is_read', ['0', '1']);
            $table->enum('is_hidden', ['0', '1']);
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
        Schema::dropIfExists('notifications');
    }
}
