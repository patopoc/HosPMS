<?php

namespace Hotpms;

use Illuminate\Database\Eloquent\Model;

class FacilityPlan extends Model
{
    protected $table= "facilities_plan";
    
    public $timestamps= false;
    
    protected $fillable= ['name'];
    
    public function facilities(){
    	return $this->belongsToMany('Hotpms\Facility','facilities_facilities_plan', 'id_facilities_plan','id_facilities');
    }
}
