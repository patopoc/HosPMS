<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function(Blueprint $table){
        	$table->increments('id');
        	$table->string('name',20);
        	$table->string('description',30);
        	$table->string('icon', 50);
        	$table->string('route',50);
        	$table->string('type',10);
        	$table->integer('id_module')->nullable();
        	$table->string('action',10)->default("");
        	$table->integer('id_section')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu');
    }
}
