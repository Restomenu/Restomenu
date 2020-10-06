<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrCodeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr_code_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->nullable()->references('id')->on('restaurants')->onDelete('cascade');
            $table->string('quantity')->nullable();
            $table->string('sticker_cost')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->string('total_cost')->nullable();
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
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
        Schema::dropIfExists('qr_code_orders');
    }
}
