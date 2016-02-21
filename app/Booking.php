<?php

namespace Hotpms;

use Illuminate\Database\Eloquent\Model;
use Hotpms\Helpers\DateHelper;

class Booking extends Model
{
	public $timestamps= false;
	
	protected $fillable = ['id_property', 'id_user', 'person', 'date', 'check_in', 
							'check_out', 'arrival_time', 'comments_and_requests', 
							'id_room_type', 'number_of_rooms', 'adults', 'children',
							'pets', 'rate_plan', 'notification','status'] ;
	
	public function property(){
		return $this->hasOne('Hotpms\Property','id','id_property');
	}
	
	public function user(){
		return $this->hasOne('Hotpms\User','id','id_user');
	}
	
	public function personData(){
		return $this->hasOne('Hotpms\Person','id','person');
	}
	
	public function roomType(){
		return $this->hasOne('Hotpms\RoomType','id','id_room_type');
	}
	
	public function rate(){
		return $this->hasOne('Hotpms\Rate','id','rate_plan');
	}
	
	public function getTotalPriceAttribute(){
		$dateRange= DateHelper::date_range($this->check_in, $this->check_out);
		$totalPrice=0;
		foreach ($dateRange as $date){
			if(DateHelper::isWeekend($date)){
				$totalPrice += $this->rate->weekend_price;
			}
			else{
				$totalPrice += $this->rate->weekday_price;
			}
		}
		
		$services= $this->roomType->servicePlans->services;
		if($services !== null){
			foreach ($services as $service){
				$totalPrice += $service->price;
			}
		}
		return $totalPrice;
	}
	
	public function getNumberOfDaysAttribute(){
		$checkIn= new \DateTime($this->check_in);
		$checkOut= new \DateTime($this->check_out);
		$dateDifference= date_diff($checkIn, $checkOut, true)->format("%a");
		
		return intval($dateDifference) + 1;		
	}
	
	public function fullData(){
		$data= ['ci' => $this->personData->ci, 
				'name' => $this->personData->name,
				'last_name' => $this->personData->last_name,
				'email' => $this->personData->email,
				'telephone' => $this->personData->telephone,
				'country' => $this->personData->country->name,				
				'date' => $this->date, 
				'check_in' => $this->check_in,
				'check_out' => $this->check_out, 
				'arrival_time' => $this->arrival_time, 
				'comments_and_requests' => $this->comments_and_requests, 
				'room_type' => $this->roomType->name, 
				'number_of_rooms' => $this->number_of_rooms, 
				'adults' => $this->adults, 
				'children' => $this->children,
				'pets' => $this->pets, 
				'rate_plan' => $this->rate->name,	
				
		] ;
		
		return $data; 
	}
}
