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
use Hospms\Http\Requests\EditStaffTypeRequest;


class StaffTypeController extends Controller
{
	

	private $data;
	
	public function __construct(){
		
		$this->middleware('access_control');
		$currentRoute= $this->getRouter()->current()->getAction()["as"];
		
		//take the controller name from the route name		
		$this->data["controllerRouteName"]= explode(".", $currentRoute)[1];		
		
		$this->middleware('set_current_section:'.$currentRoute);	
		
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)    
    {
    	$labels= [
    			"key" => "models.staff_type",
    			"title" => "titleList",
    			"list" => [   
    					"name" => "text",
    					"description" => "text",    					    					
    			],
    	];
    	
    	$staffTypes= StaffType::paginate(10);
    	
    	$data= $this->data;
    	$data["labels"]= $labels;
    	$data["models"]= $staffTypes;
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
    			"key" => "models.staff_type",
    			"title" => "titleCreate",
    			"fields" => [
    					"name" => "text",
    					"description" => "text",    					
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
    public function store(CreateStaffTypeRequest $request)
    {
        StaffType::create($request->all());
        
        return \Redirect::route('admin.staff_types.index');
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
    			"key" => "models.staff_type",
    			"title" => "titleEdit",
    			"fields" => [
    					"name" => "text",
    					"description" => "text",    					
    			],
    	];
    	
    	$data= $this->data;
    	$data['fieldsData']= $fields;
        $data["models"]= StaffType::findOrFail($id);        
        
        return view('admin.commoncrud.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditStaffTypeRequest $request, $id)
    {
        $model= StaffType::findOrFail($id);
        $model->fill($request->all());
        $model->save();
        $message= $model->name. ' updated successfully';
        
        if($request->ajax()){
        	return $message;
        }
        
        Session::flash('message', $message);        
        
        return redirect()->route('admin.staff_types.index');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $model= StaffType::findOrFail($id);
        
        $message="";
        try{
        	$model->delete();
        	$message= trans('appstrings.item_removed', ['item' => $model->name]);
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
        
        return redirect()->route('admin.staff_types.index');
    }
}
