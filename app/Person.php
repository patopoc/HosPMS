<?php namespace Hospms;

use Illuminate\Database\Eloquent\Model;

class Person extends Model{
	
	public $timestamps= false;
	
	protected $fillable = ['ci', 'name', 'last_name', 'email', 'telephone', 
							'id_country', 'id_blood_group', 'birth_date', 'id_picture'];
	
	public function country(){
		return $this->hasOne("Hospms\Country","id", "id_country");
	}
	
	public function bloodGroup(){
		return $this->hasOne("Hospms\BloodGroup", "id", "id_blood_group");
	}
	public function getFullNameAttribute(){
		return $this->name . " " . $this->last_name;
	}
	
	public function scopeName($query, $name){
		if($name !== ""){
			$query->where(\DB::raw("CONCAT(lower(name), ' ', lower(last_name))"), "LIKE", "%". strtolower($name). "%");
		}
	}
	
	public function picture(){
		return $this->hasOne('Hospms\Picture', 'id', 'id_picture');
	}
	
	public function fullData(){ 
		
		$data= [
				'ci' => $this->ci,
				'name' =>$this->name,
				'last_name' => $this->last_name,
				'email' => $this->email,
				'telephone' => $this->telephone,
				'country' => $this->country->name
		];
				
		return $data;
	}
	
}