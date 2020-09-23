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
            $table->foreignId('restaurant_type_id')->after('remember_token')->nullable()->references('id')->on('restaurant_types')->onDelete('no action');
            $table->string('amount_of_employees')->after('restaurant_type_id')->nullable();
            $table->foreignId('country_id')->after('amount_of_employees')->nullable()->references('id')->on('countries')->onDelete('no action');
            $table->text('street')->after('country_id')->nullable();
            $table->string('house_number')->after('street')->nullable();
            $table->string('province')->after('house_number')->nullable();
            $table->string('VAT_number')->after('province')->nullable();
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
            $table->dropColumn(['restaurant_type_id']);

            $table->dropColumn('amount_of_employees');

            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');

            $table->dropColumn('street');
            $table->dropColumn('house_number');
            $table->dropColumn('province');
            $table->dropColumn('VAT_number');
        });
    }
}
