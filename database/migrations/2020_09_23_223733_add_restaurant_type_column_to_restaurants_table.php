<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRestaurantTypeColumnToRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->renameColumn('name', 'first_name');
            $table->string('last_name')->after('name')->nullable();
            $table->foreignId('restaurant_type_id')->after('remember_token')->nullable()->references('id')->on('restaurant_types')->onDelete('no action');
            $table->string('number_of_employees')->after('restaurant_type_id')->nullable();
            $table->foreignId('city_id')->after('number_of_employees')->nullable()->references('id')->on('cities')->onDelete('no action');
            $table->text('street_and_house_number')->after('city_id')->nullable();
            $table->string('province')->after('street_and_house_number')->nullable();
            $table->string('VAT_number')->after('province')->nullable();
            $table->string('phone_billing')->after('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {

            $table->dropForeign(['restaurant_type_id']);
            $table->dropForeign(['city_id']);
            $table->dropColumn(['last_name', 'restaurant_type_id', 'number_of_employees', 'city_id', 'street_and_house_number', 'province', 'VAT_number', 'phone_billing']);
            $table->renameColumn('first_name', 'name');
        });
    }
}
