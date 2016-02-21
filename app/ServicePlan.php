<?php

namespace Hospms;

use Illuminate\Database\Eloquent\Model;

class ServicePlan extends Model
{
    protected $table= "service_plan";
    
    public $timestamps= false;
    
    protected $fillable= ['name'];
    
    public function services(){
    	return $this->belongsToMany('Hospms\Service','services_service_plan', 'id_service_plan','id_service');
    }
}
