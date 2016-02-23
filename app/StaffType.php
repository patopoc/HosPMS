<?php namespace Hospms;

use Illuminate\Database\Eloquent\Model;

class StaffType extends Model{
	
	public $timestamps= false;
	
	public $table="staff_types";
	
	protected $fillable = ['name', 'description'];
	
	
	public function fullData(){
		$data= [
				'name' =>$this->name,
				'description' => $this->description,				
		];
	
		return $data;
	}
}