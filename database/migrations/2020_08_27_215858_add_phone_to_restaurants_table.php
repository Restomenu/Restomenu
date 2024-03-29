<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneToRestaurantsTable extends Migration
{
    /**	
     * Run the migrations.	
     *	
     * @return void	
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('phone')->after('email')->nullable();
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
            $table->dropColumn('phone');
        });
    }
}
