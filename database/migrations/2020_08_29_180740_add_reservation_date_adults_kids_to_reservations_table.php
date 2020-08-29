<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReservationDateAdultsKidsToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('adults')->after('email')->nullable();
            $table->string('kids')->after('adults')->nullable();
            $table->date('appointment_date')->after('is_terms_checked')->nullable();
            $table->tinyInteger('have_covid')->after('appointment_status')->default(0)->comment('0: no, 1:yes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['adults', 'kids', 'appointment_date', 'have_covid']);
        });
    }
}
