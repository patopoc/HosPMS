<?php namespace Hospms;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model{
	
	public $timestamps= false;
	
	public $table="staff";
	
	protected $fillable = ['id_person', 'id_staff_type', 'id_department', 'profile'];
	
	public function person(){
		return $this->hasOne("Hospms\Person", "id", "id_person");
	}
	
	public function scopeName($query, $name){
		if($name !== ""){
			$query->leftjoin('people', 'staff.id_person', '=', 'people.id')
				  ->where(\DB::raw("CONCAT(lower(people.name), ' ', lower(people.last_name))"), "LIKE", "%". strtolower($name). "%")
			      ->select('staff.id', 'staff.id_person', 'staff.id_staff_type', 'staff.id_department');
		}
	}
	
	public function type(){
		return $this->hasOne("Hospms\StaffType", "id", "id_staff_type");
	}
	
	public function department(){
		return $this->hasOne("Hospms\Department", "id", "id_department");
	}
	
	public function fullData(){
		$pictureUrl="";
		if($this->person->id_picture != 0)
			$pictureUrl= $this->person->picture->url;
		
		$data= [
				'ci' => $this->person->ci,
				'name' => $this->person->name,
				'last_name' => $this->person->last_name,
				'gender' => $this->person->gender,
				'email' => $this->person->email,
				'telephone' => $this->person->telephone,
				'id_country' => $this->person->id_country,
				'id_blood_group' => $this->person->id_blood_group,
				'picture' => $pictureUrl,				
				'id_staff_type' => $this->id_staff_type,
				'id_department' => $this->id_department,
				'department' => $this->department->name,
				'profile' => $this->profile,
		];
	
		return $data;
	}
}