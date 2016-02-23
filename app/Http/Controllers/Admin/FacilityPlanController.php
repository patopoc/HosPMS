<?php

namespace Hospms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hospms\Http\Requests;
use Hospms\Http\Controllers\Controller;
use Hospms\Http\Requests\CreateFacilityPlanRequest;
use Illuminate\Support\Facades\Session;
use Hospms\Http\Requests\EditServiceRequest;
use Hospms\FacilityPlan;
use Illuminate\Database\Eloquent\Model;
use Hospms\Http\Requests\EditFacilityPlanRequest;
use Hospms\Facility;
use Hospms\Helpers\ArrayCheckHelper;

class FacilityPlanController extends Controller
{
	private $data=null;
	public function __construct(){
	
		$this->middleware('access_control');
		$currentRoute= $this->getRouter()->current()->getAction()["as"];
		
		//take the controller name from the route name
		$this->data["controllerRouteName"]= explode(".", $currentRoute)[1];
		
		$this->middleware('set_current_section:'.$currentRoute);
		
		$facilities= \DB::table("facilities")->lists('name','id');
		 
		/*$facilitiesArray[]= array(
				"key" => 0,
				"val" => "Select Facility"
		);*/
		
		$facilities= array("0" => "Select Facility") + $facilities;
		 
		foreach($facilities as $key => $val){
			$facilitiesArray[]= [
					"key" => $key,
					"val" => $val,
			];
		}
		
		//$this->data["facilities"]= $facilities;
		//$this->data['facilitiesJson']= $facilitiesArray;
		
		$this->data['selectData']['facilities']= $facilities;
		$this->data['selectData']['facilitiesJson']= $facilitiesArray;
		
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facility_plans= FacilityPlan::all();
        return view('admin.facility_plans.index', compact('facility_plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	
    	//$data= $this->data;  
    	//return view('admin.facility_plans.create', compact('data'));
    	
    	$fields= [
    			"key" => "models.facility_plan",
    			"title" => "titleCreate",
    			"fields" => [
    					"name" => "text",
    					"facilities" => "select-group",    					
    			],
    			 
    	];
    	
    	$data= $this->data;
    	$data['fieldsData']= $fields;
    	
    	return view('admin.commoncrud.create', compact('data'));
    	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFacilityPlanRequest $request)
    {       	
        //$data= $request->all();
        $facilityKeys= array();
        $facilityKeys= ArrayCheckHelper::ignoreRepeated($request->all(), "facilities");
        /*foreach($request->all() as $key => $val){
        	if(preg_match("%^facility[0-9]+$%", $key) && $val !== ""){
        		//check that a value doesn't repeat
        		$repeatedVal= false;
        		foreach($facilityKeys as $facilityKey){
        			if($val == $facilityKey){
        				$repeatedVal=true;
        				break;
        			}
        		}
        		if(!$repeatedVal)
        			$facilityKeys[]= $val;
        	}
        }
        /*foreach($request->all() as $key => $val){
        	if($key !== "_token" && $key !=="name")
        		$facilityKeys[]= $val;	
        } */      
    	$facility_plan= FacilityPlan::create($request->all());
    	$facility_plan->facilities()->attach($facilityKeys);
        
        return \Redirect::route('admin.facility_plans.index');
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
    	
    	$fields= [
    			"key" => "models.facility_plan",
    			"title" => "titleEdit",
    			"fields" => [
    					"name" => "text",
    					"facilities" => "select-group",    					
    			],
    			 
    	];
    	
    	$data= $this->data;
    	$data['fieldsData']= $fields;
    	    	
        $facility_plan= FacilityPlan::findOrFail($id);        
        //$data['facility_plan']= $facility_plan;        
        
        //return view('admin.facility_plans.edit', compact('data'));
        $data['model']= $facility_plan;
        return view('admin.commoncrud.edit', compact('data'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditFacilityPlanRequest $request, $id)
    {
    	$facilityKeys= ArrayCheckHelper::ignoreRepeated($request->all(), "facilities");
    	
    	/*foreach($request->all() as $key => $val){
    		if($key !== "_token" && $key !=="name")
    			$facilityKeys[]= $val;
    	}*/
    	
    	
    	$facility_plan= FacilityPlan::find($id);
    	$facility_plan->fill($request->all());
    	$facility_plan->save();
    	 
    	$facility_plan->facilities()->sync($facilityKeys);
        
        $message= $facility_plan->name . ' updated succesfully';
        if($request->ajax()){
        	return $message;
        }
        Session::flash('message',$message);
        return redirect()->route('admin.facility_plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $facility= FacilityPlan::findOrFail($id);
        $message="";
        
        try{       	        	
        	$facility->delete();
        	
        	\DB::table("facilities_facilities_plan")
        	->where("id_facilities_plan", $id)
        	->delete();
        	
        	$message= trans('appstrings.item_removed', ['item' => $facility->name]);
        	Session::flash('message_type', 'success');
        }
        catch(\PDOException $e){
        	$message= trans('sqlmessages.' . $e->getCode());
        	if($message == 'sqlmessages.' . $e->getCode()){
        		$message= trans('sqlmessages.undefined');
        	}
        	
        	if($request->ajax()){
        		return ['code'=>'error', 'message' => $message];
        	}
        	
        	Session::flash('message_type', 'error');
        }
        
        if($request->ajax()){
        	return ['code'=>'ok', 'message' => $message];
        }
        
        Session::flash('message', $message);
        
        return redirect()->route('admin.facility_plans.index');
    }
}
