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


class StaffController extends Controller
{

	private $data;
	
	public function __construct(Request $request){
		$this->middleware('access_control');
		$currentRoute= $this->getRouter()->current()->getAction()["as"];
		
		//take the controller name from the route name		
		$this->data["controllerRouteName"]= explode(".", $currentRoute)[1];		
		
		//Set the Section title related to staff_type parameter if exists
		if($request->has("staff_type")){
			$this->middleware('set_current_section:'. $currentRoute .",". $request->get("staff_type"));
		}
		else{
			$this->middleware('set_current_section:'. $currentRoute);
		}
		
		$countriesShortList= \DB::table('countries')->lists('name', 'country_code');
		$this->data['selectData']['id_country']= array(""=>"Select Country") + $countriesShortList;
		
		$staffTypeShortList= \DB::table('staff_types')->lists('name', 'id');
		$this->data['selectData']['id_staff_type']= array(""=>"Select Staff Type") + $staffTypeShortList;
		
		$departmentsShortList= \DB::table('departments')->lists('name', 'id');
		$this->data['selectData']['id_department']= array(""=>"Select Department") + $departmentsShortList;
		
		
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)    
    {
    	$labels= [
    			"key" => "models.staff",
    			"title" => "titleList",
    			"list" => [   
    					"ci" => "link",
    					"name" => "text",
    					"department" => "text",    					    					
    			],
    	];

    	$staffTypeName= $request->get("staff_type");
		session(["staffTypeName" => $staffTypeName]);
		
    	$staffType= StaffType::where("name",$staffTypeName)->first();
    	if($staffType === null)
    		return redirect()->back();
    	
    	$staff= null;
    	if($request->has('name')){
    		$staff= Staff::name($request->get('name'))->paginate(10);
    	}
    	else{
    		$staff= Staff::where("id_staff_type", $staffType->id )->paginate(10);
    	}
    	    	
    	
    	
    	$data= $this->data;
    	$data["labels"]= $labels;
    	$data["models"]= $staff;
    	$data["titleParams"]= array("staff_type" =>session("staffTypeName"));
    	$data["routeParams"]= array("staff_type" => session("staffTypeName"));
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
    			"key" => "models.staff",
    			"title" => "titleCreate",
    			"fields" => [
    					"ci" => "text",
    					"name" => "text",
    					"last_name" => "text",
    					"email" => "email",
    					"telephone" => "text",
    					"id_country" => "select",
    					"id_department" => "select",
    					"profile" => "text"
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
    public function store(CreateStaffRequest $request)
    {
    	if(count(Person::where('ci',$request->get('ci'))->get()) == 0){
    		Person::create([
    				'ci' => $request->get('ci'),
    				'name' => $request->get('name'),
    				'last_name' => $request->get('last_name'),
    				'email' => $request->get('email'),
    				'telephone' => $request->get('telephone'),
    				'id_country' => $request->get('id_country'),
    		]);
    	}
    	 
    	$person= Person::where('ci',$request->get('ci'))->get()->first();
    	$staffType= StaffType::where("name",session("staffTypeName"))->first();
        
        $staff= new Staff([
        		"id_person" => $person->id,
        		"id_staff_type" => $staffType->id,
        		"id_department" => $request->get("id_department"),
        		"profile" => $request->get("profile"),        
        ]);
        
        $staff->save();        
        
        return redirect("/admin/staff?staff_type=" . session("staffTypeName"));
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
    			"key" => "models.staff",
    			"title" => "titleCreate",
    			"fields" => [
    					"ci" => "text",
    					"name" => "text",
    					"last_name" => "text",
    					"email" => "email",
    					"telephone" => "text",
    					"id_country" => "select",
    					"id_department" => "select",
    					"profile" => "text"
    			],
    	];
    	
    	
    	$data= $this->data;
    	$data['fieldsData']= $fields;       	
        $data["model"]= Staff::findOrFail($id);        
        $data["routeParam"]= "staff_type=" . session("staffTypeName");
        return view('admin.commoncrud.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditStaffRequest $request, $id)
    {
    	$person= Person::where('ci',$request->get('ci'))->get()->first();
    	$person->fill([
    			'name' => $request->get('name'),
    			'last_name' => $request->get('last_name'),
    			'email' => $request->get('email'),
    			'telephone' => $request->get('telephone'),
    			'id_country' => $request->get('id_country'),
    	]);
    	$person->save();
    	
        $model= Staff::findOrFail($id);
        $staffType= StaffType::where("name",session("staffTypeName"))->first();
        
        $model->fill([
        		"id_person" => $person->id,
        		"id_staff_type" => $staffType->id,
        		"id_department" => $request->get("id_department"),
        		"profile" => $request->get("profile"),
        ]);
        $model->save();
        $message= $model->name. 'updated successfully';
        
        if($request->ajax()){
        	return $message;
        }
                
        Session::flash('message', $message);        
        return redirect("/admin/staff?staff_type=" . session("staffTypeName"));        
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $staff= Staff::findOrFail($id);
        
        $message="";
        try{
        	$staff->delete();
        	$message= trans('appstrings.item_removed', ['item' => $staff->person->full_name]);
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
        
        return redirect("/admin/staff?staff_type=" . session("staffTypeName"));
    }
}
