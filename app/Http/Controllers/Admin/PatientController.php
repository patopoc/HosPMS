<?php

namespace Hospms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hospms\Http\Requests;
use Hospms\Http\Controllers\Controller;
use Hospms\Person;
use Illuminate\Support\Facades\Session;
use Webpatser\Countries\Countries;
use Hospms\Http\Requests\CreatePersonRequest;
use Hospms\Http\Requests\EditPersonRequest;
use Illuminate\Database\QueryException;
use Hospms\Helpers\ModelHelper;
use Hospms\Department;
use Hospms\Http\Requests\CreateDepartmentRequest;
use Hospms\Http\Requests\EditDepartmentRequest;
use Hospms\Staff;
use Hospms\StaffType;
use Hospms\Http\Requests\CreateStaffTypeRequest;
use Hospms\Http\Requests\CreateStaffRequest;
use Hospms\Http\Requests\EditStaffRequest;
use Hospms\Patient;
use Hospms\Http\Requests\CreatePatientRequest;
use Hospms\Http\Requests\EditPatientRequest;


class PatientController extends Controller
{

	private $data;
	
	public function __construct(){
		$this->middleware('access_control');
		$currentRoute= $this->getRouter()->current()->getAction()["as"];
		
		//take the controller name from the route name		
		$this->data["controllerRouteName"]= explode(".", $currentRoute)[1];		
		
		$this->middleware('set_current_section:'.$currentRoute);	
		
		$countriesShortList= \DB::table('countries')->lists('name', 'country_code');
		$this->data['selectData']['id_country']= array(""=>"Select Country") + $countriesShortList;
		
		$bloodGroups= \DB::table('blood_groups')->lists('name', 'id');
		$this->data['selectData']['id_blood_group']= array(""=>"Select Blood Type") + $bloodGroups;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)    
    {
    	$labels= [
    			"key" => "models.patient",
    			"title" => "titleList",
    			"list" => [   
    					"ci" => "link",
    					"full_name" => "text",
    					"email" => "text",
    					"blood_group" => "text",
    			],
    	];
    	   	
    	   	
    	$patient= Patient::paginate(10);    	
    	
    	
    	$data= $this->data;
    	$data["labels"]= $labels;
    	$data["models"]= $patient;
    	
		return view('admin.commoncrud.index', compact('data'));		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    	  
    	$fields= [
    			"key" => "models.patient",
    			"title" => "titleCreate",
    			"fields" => [
    					"ci" => "text",
    					"name" => "text",
    					"last_name" => "text",
    					"gender" => "text",
    					"email" => "email",
    					"telephone" => "text",
    					"id_country" => "select",
    					"id_blood_group" => "select",
    					"birth_date" => "text",
    					"id_picture" => "text",
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
    public function store(CreatePatientRequest $request)
    {
    	if(count(Person::where('ci',$request->get('ci'))->get()) == 0){
    		Person::create([
    				'ci' => $request->get('ci'),
    				'name' => $request->get('name'),
    				'last_name' => $request->get('last_name'),
    				'gender' => $request->get('gender'),
    				'email' => $request->get('email'),
    				'telephone' => $request->get('telephone'),
    				'id_country' => $request->get('id_country'),
    				'id_blood_group' => $request->get('id_blood_group'),
    				'birth_date' => $request->get("birth_date"),
    				'id_picture' => $request->get("id_picture"),
    		]);
    	}
    	 
    	$person= Person::where('ci',$request->get('ci'))->get()->first();
        
        $patient= new Patient([
        		"id_person" => $person->id,        		        
        ]);
        
        $patient->save();        
        
        return redirect()->route("admin.patients.index");
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
    			"key" => "models.patient",
    			"title" => "titleCreate",
    			"fields" => [
    					"ci" => "text",
    					"name" => "text",
    					"last_name" => "text",
    					"gender" => "text",
    					"email" => "email",
    					"telephone" => "text",
    					"id_country" => "select",
    					"id_blood_group" => "select",
    					"birth_date" => "text",
    					"id_picture" => "text",
    			],
    	];
    	
    	
    	$data= $this->data;
    	$data['fieldsData']= $fields;       	
        $data["model"]= Patient::findOrFail($id);       
        
        return view('admin.commoncrud.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPatientRequest $request, $id)
    {
    	$person= Person::where('ci',$request->get('ci'))->get()->first();
    	$person->fill([
    			'name' => $request->get('name'),
    			'last_name' => $request->get('last_name'),
    			'gender' => $request->get('gender'),
    			'email' => $request->get('email'),
    			'telephone' => $request->get('telephone'),
    			'id_country' => $request->get('id_country'),
    			'id_blood_group' => $request->get('id_blood_group'),
    			'birth_date' => $request->get("birth_date"),
    			'id_picture' => $request->get("id_picture"),
    	]);
    	$person->save();
    	
        $model= Patient::findOrFail($id);
        
        $model->fill([
        		"id_person" => $person->id,
        ]);
        $model->save();
        $message= $model->name. 'updated successfully';
        
        if($request->ajax()){
        	return $message;
        }
                
        Session::flash('message', $message);        
        return redirect()->route("admin.patients.index");        
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $patient= Patient::findOrFail($id);
        
        $message="";
        try{
        	$patient->delete();
        	$message= trans('appstrings.item_removed', ['item' => $patient->person->full_name]);
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
        
        return redirect()->route("admin.patients.index");
    }
}
