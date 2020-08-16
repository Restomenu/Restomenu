<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCanTakeawayToComboDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('combo_dishes', function (Blueprint $table) {
            $table->tinyInteger('can_takeaway')->after('image')->default(1)->comment('0: no, 1:yes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combo_dishes', function (Blueprint $table) {
            $table->dropColumn('can_takeaway');
        });
    }
}
