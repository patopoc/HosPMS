<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Hotpms\Booking;

class BookingTableSeeder extends Seeder
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
        $roomTypes= \DB::table('room_types')->lists('id');
        for($i=0; $i < 10 ; $i++){
        	$checkIn= $faker->dateTimeBetween('now','+6 months')->format("Y-m-d");
        	$checkOut= date('Y-m-d',strtotime($checkIn) + 345600);
        	
        	$reference_code;
        	do{
        		$reference_code= str_random(10);
        	}while(count(Booking::where('reference_code',$reference_code)->get()) > 0);
        	
        	\DB::table('bookings')->insert(array(
        			'id_property' => $properties[array_rand($properties, 1)],
        			'id_user' => 2,
        			'person' => $people[array_rand($people, 1)],
        			'date' => date('Y-m-d'),
        			'check_in' => $checkIn,
        			'check_out' => $checkOut,        			
        			'arrival_time' => $faker->time($format = 'H:i:s', $max = 'now'),
        			'comments_and_requests' => "",
        			'id_room_type' => $roomTypes[array_rand($roomTypes,1)],
        			'number_of_rooms' => 2,
        			'adults' => 1,
        			'children' => 0,
        			'pets' => 0,
        			'rate_plan' => 3,   
        			'notification' => 'none',
        			'reference_code' => $reference_code,
        			
        	));
        }
    }
}
