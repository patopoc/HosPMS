<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE bookings ADD reference_code varchar(10) NOT NULL ;');
        DB::statement('ALTER TABLE bookings ADD status varchar(1) NOT NULL ;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	DB::statement('ALTER TABLE bookings DROP COLUMN reference_code;');
    }
}
