<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->nullable()->references('id')->on('restaurants')->onDelete('cascade');
            $table->string('site_logo')->nullable();
            $table->string('site_name')->nullable();
            $table->string('language_english')->nullable();
            $table->string('language_dutch')->nullable();
            $table->string('language_french')->nullable();
            $table->string('fb_url')->nullable();
            $table->string('ig_url')->nullable();
            $table->string('tw_url')->nullable();
            $table->string('admin_language_english')->nullable();
            $table->string('admin_language_dutch')->nullable();
            $table->string('admin_language_french')->nullable();
            $table->string('defualt_language')->nullable();
            $table->string('menu_primary_color')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
