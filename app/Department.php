<?php namespace Hospms;

use Illuminate\Database\Eloquent\Model;

class Department extends Model{
	
	public $timestamps= false;
	
	public $table="departments";
	
	protected $fillable = ['name', 'description'];
	
	public function fullData(){
		$data= [
				'name' =>$this->name,
				'description' => $this->description,				
		];
	
		return $data;
	}
}