<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    	
    	Model::unguard();

        //$this->call('CountriesSeeder');
        //$this->command->info('Seede the countries!');
        
        //$this->call('PeopleTableSeeder');
        //$this->call('RolesTableSeeder');
        $this->call('BookingTableSeeder');
        

        Model::reguard();
    }
}
