<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRoleDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	//This table have a composite primary key made of id_role and id_module, but since Eloquent and its methods are apparently 
    	//so dependent of the 'id' field, it was added to the composite key and after all that, it was set to AUTOINCREMENT
    	//This way Eloquent can have this unique identifier so it can use its methods correctly
    	
        Schema::create('role_detail', function(Blueprint $table){
        	$table->integer('id');
        	$table->integer('id_role');
        	$table->integer('id_module');
        	$table->boolean('mod_show')->default(false);
        	$table->boolean('mod_insert')->default(false);
        	$table->boolean('mod_update')->default(false);
        	$table->boolean('mod_delete')->default(false);
        });
                
        DB::statement("ALTER TABLE role_detail ADD PRIMARY KEY(id, id_role, id_module);");
        DB::statement("ALTER TABLE role_detail MODIFY id int AUTO_INCREMENT;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_detail');
    }
}
