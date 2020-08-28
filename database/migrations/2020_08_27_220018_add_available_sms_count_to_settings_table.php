<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvailableSmsCountToSettingsTable extends Migration
{
    /**	
     * Run the migrations.	
     *	
     * @return void	
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->tinyInteger('sms_service_status')->after('site_name')->default(1)->comment('0: no, 1:yes');
            $table->string('available_sms_count')->after('sms_service_status')->nullable();
        });
    }

    /**	
     * Reverse the migrations.	
     *	
     * @return void	
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['available_sms_count', 'sms_service_status']);
        });
    }
}
