<?php

namespace Hotpms;

use Illuminate\Database\Eloquent\Model;

class ServicePlan extends Model
{
    protected $table= "service_plan";
    
    public $timestamps= false;
    
    protected $fillable= ['name'];
    
    public function services(){
    	return $this->belongsToMany('Hotpms\Service','services_service_plan', 'id_service_plan','id_service');
    }
}
