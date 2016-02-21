<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class ModifyBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	//this won´t work because the table has enum fields
        /*Schema::table('bookings', function(Blueprint $table){
        	$table->date('check_in')->change();
        	$table->date('check_out')->change();
        	$table->date('comments_and_requests')->nullable()->change();        	
        });*/
        DB::statement("ALTER TABLE bookings MODIFY notification ENUM('none','email','telephone') default 'none';");
        DB::statement("ALTER TABLE bookings MODIFY status char(1) default 'a';");
        DB::statement("ALTER TABLE bookings MODIFY check_in date;");
        DB::statement("ALTER TABLE bookings MODIFY check_out date;");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
