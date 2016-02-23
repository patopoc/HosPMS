<?php namespace Hospms;

use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model{
	
	public $timestamps= false;
	
	public $table="blood_groups";
	
	protected $fillable = ['name'];
	
	
	public function fullData(){
		$data= [
				'name' =>$this->name,								
		];
	
		return $data;
	}
}