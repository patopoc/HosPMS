<?php

namespace Hospms;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table= "property_settings";
    
    public $timestamps= false;
    
    protected $fillable= ['name','info','address', 'time_zone', 'phone', 'currency', 'email', 'lang', 'text_alignment' ];
    
    public function pictures(){
    	return $this->hasMany('Hospms\Picture','id_module','id');
    }
    
    public function getLogoAttribute(){
    	return $this->pictures->where('type','logo')->first();	
    }
    
    public function removeLogo(){
    	$logo= $this->logo;
    	if($logo !== null){
    		unlink(public_path() . $logo->url);
    		$logo->delete();   
    		
    	}
    }
    
    public function fullData(){
    	$logoUrl="";
    	if($this->logo !== null)
    		$logoUrl= asset($this->logo->url);
    	
    	$data=[
    			'name' => $this->name,
    			'info' => $this->info,
    			'logo' => $logoUrl,
    			'address' => $this->address,
    			'checkin_time' => $this->checkin_time,
    			'checkout_time' => $this->checkout_time,
    			'cancelation_policy' => $this->cancelation_policy,
    			'time_zone' => $this->time_zone, 
    			'conditions' => $this->conditions, 
    			'pet_rules' => $this->pet_rules
    	];
    	return $data;
    }
}
