<?php namespace Hospms;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model{
	
	public $timestamps= false;
	
	public $table="patients";
	
	protected $fillable = ['id_person'];
	
	public function person(){
		return $this->hasOne("Hospms\Person", "id", "id_person");
	}
		
	public function fullData(){
		$pictureUrl="";
		$bloodGroup="";
		if($this->person->id_picture != 0)
			$pictureUrl= $this->person->picture->url;
		
		if($this->person->id_blood_group != 0)
			$bloodGroup= $this->person->bloodGroup->name;		
		
		$data= [
				'ci' => $this->person->ci,
				'name' => $this->person->name,
				'last_name' => $this->person->last_name,
				'full_name' => $this->person->full_name,
				'gender' => $this->person->gender,
				'email' => $this->person->email,
				'telephone' => $this->person->telephone,
				'id_country' => $this->person->id_country,
				'country' => $this->person->country->name,
				'id_blood_group' => $this->person->id_blood_group,
				'blood_group' => $bloodGroup,
				'picture' => $pictureUrl,	
				
		];
	
		return $data;
	}
}