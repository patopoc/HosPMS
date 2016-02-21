<?php

namespace Hotpms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hotpms\Http\Requests;
use Hotpms\Http\Controllers\Controller;
use Hotpms\Http\Requests\CreateServicePlanRequest;
use Illuminate\Support\Facades\Session;
use Hotpms\Http\Requests\EditServiceRequest;
use Hotpms\ServicePlan;
use Illuminate\Database\Eloquent\Model;
use Hotpms\Http\Requests\EditServicePlanRequest;
use Hotpms\Helpers\ArrayCheckHelper;

class ServicePlanController extends Controller
{
	private $data= null;
	public function __construct(){
	
		$this->middleware('access_control');
		$currentRoute= $this->getRouter()->current()->getAction()["as"];
		$this->middleware('set_current_section:'.$currentRoute);
		
		$services= \DB::table("services")->lists('name','id');
		$servicesArray[]= array(
				"key" => 0,
				"val" => "Select Service"
		);
		
		foreach ($services as $key => $val){
			$servicesArray[]= [
					"key" => $key,
					"val" => $val
			];
		}
		
		$this->data['services']= $services;
		$this->data['servicesJson']= $servicesArray;
		
	}    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service_plans= ServicePlan::all();
        return view('admin.service_plans.index', compact('service_plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$data= $this->data;
        return view('admin.service_plans.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServicePlanRequest $request)
    {       	
        $data= $request->all();
        $serviceKeys= array();
                   	
        $serviceKeys= ArrayCheckHelper::ignoreRepeated($request->all(), "service");
        /*foreach($request->all() as $key => $val){
        	if(preg_match("%^service[0-9]+$%", $key) && $val !== ""){
        		//check that a value doesn't repeat
        		$repeatedVal= false;
        		foreach($serviceKeys as $serviceKey){
        			if($val == $serviceKey){
        				$repeatedVal=true;
        				break;
        			}
        		}
        		if(!$repeatedVal)
        			$propertyKeys[]= $val;
        	}
        }
        
        /*foreach($request->all() as $key => $val){
        	if($key !== "_token" && $key !=="name")
        		$serviceKeys[]= $val;	
        } */      
        
    	$service_plan= ServicePlan::create($request->all());
    	$service_plan->services()->attach($serviceKeys);
        
        return \Redirect::route('admin.service_plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$data= $this->data;
        $data['service_plan']= ServicePlan::findOrFail($id);
        return view('admin.service_plans.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditServicePlanRequest $request, $id)
    {
        $serviceKeys= ArrayCheckHelper::ignoreRepeated($request->all(), "service");
    	$service_plan= ServicePlan::findOrFail($id);
        $service_plan->fill($request->all());
        $service_plan->save();
        
        $service_plan->services()->sync($serviceKeys);
        
        $message= $service_plan->name.' updated successfully';
        if($request->ajax()){
        	return $message;
        }
        Session::flash('message',$message);
        return redirect()->route('admin.service_plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $service= ServicePlan::findOrFail($id);
    	
        $message="";
        try{
        	$service->delete();
        	$message= trans('appstrings.item_removed', ['item' => $service->full_name]);
        	Session::flash('message_type', 'success');
        }
        catch(\PDOException $e){
        	$message= trans('sqlmessages.' . $e->getCode());
        	if($message == 'sqlmessages.' . $e->getCode()){
        		$message= trans('sqlmessages.undefined');
        	}
        	Session::flash('message_type', 'error');
        }
        
        if($request->ajax()){
        	return ['code'=>'error', 'message' => $message];
        }
        Session::flash('message',$message);
        return redirect()->route('admin.service_plans.index');
    }
}
