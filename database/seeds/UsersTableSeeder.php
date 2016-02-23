<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Faker::create();
        
        $people= \DB::table('people')->lists('id');
        $properties= \DB::table('property_settings')->lists('id');
        
        //for($i = 0; $i < 10; $i ++){
        	\DB::table('users')->insert(array(
        			'id_person' => $people[array_rand($people, 1)],
        			'id_role' => 1,
        			'default_property' => $properties[0],
        			'username' => 'admin',
        			'password' => bcrypt("123456"),    	    			
        	));
        //}
    }
}
