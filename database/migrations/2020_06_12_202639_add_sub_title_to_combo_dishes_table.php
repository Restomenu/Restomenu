<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubTitleToComboDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('combo_dishes', function (Blueprint $table) {
            $table->longText('sub_title')->after('name_french')->nullable();
            $table->longText('sub_title_dutch')->after('sub_title')->nullable();
            $table->longText('sub_title_french')->after('sub_title_dutch')->nullable();
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
            $table->dropColumn(['sub_title', 'sub_title_dutch', 'sub_title_french']);
        });
    }
}
