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


class PeopleController extends Controller
{
	
	public $countriesShortList;
	
	private $data;
	
	public function __construct(){
		
		$this->middleware('access_control');
		$currentRoute= $this->getRouter()->current()->getAction()["as"];
		
		//take the controller name from the route name		
		$this->data["controllerRouteName"]= explode(".", $currentRoute)[1];		
		
		$this->middleware('set_current_section:'.$currentRoute);
		
		$this->countriesShortList= \DB::table('countries')->lists('name', 'country_code');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)    
    {
    	$people=null;
    	$labels= [
    			"key" => "models.person",
    			"title" => "titleList",
    			"list" => [
    					"ci" => "link",
    					"name" => "text",
    					"last_name" => "text",
    					"country" => "text",
    			],
    	];
    	   	
    	if($request->has('name')){
			$people= Person::name($request->get('name'))->paginate(10);    	
    	}
    	else{
			$people= Person::paginate(5);
    	}
    	
    	$data= $this->data;
    	$data["labels"]= $labels;
    	$data["model"]= $people;
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
    			"key" => "models.person",
    			"title" => "titleCreate",
    			"fields" => [
    					"ci" => "text",
    					"name" => "text",
    					"last_name" => "text",
    					"email" => "email",
    					"telephone" => "text",
    					"id_country" => "select",
    			],
    	];
    	
    	$data= $this->data;
    	$data['fieldsData']= $fields;    	
    	$data['selectData']= array(""=>"Select Country") + $this->countriesShortList;    	
    	return view('admin.commoncrud.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePersonRequest $request)
    {
        Person::create($request->all());
        
        return \Redirect::route('admin.commoncrud.index');
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
    			"key" => "models.person",
    			"title" => "titleEdit",
    			"fields" => [
    					"ci" => "text",
    					"name" => "text",
    					"last_name" => "text",
    					"email" => "email",
    					"telephone" => "text",
    					"id_country" => "select",
    			],
    	];
    	
    	$data= $this->data;
    	$data['fieldsData']= $fields;
        $data["model"]= Person::findOrFail($id);
        $data["selectData"]= array(""=>"Select Country") + $this->countriesShortList;
        
        
        return view('admin.commoncrud.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPersonRequest $request, $id)
    {
        $person= Person::findOrFail($id);
        $person->fill($request->all());
        $person->save();
        $message= $person->full_name. 'updated successfully';
        
        if($request->ajax()){
        	return $message;
        }
        
        Session::flash('message', $message);        
        
        return redirect()->route('admin.commoncrud.index');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $person= Person::findOrFail($id);
        
        $message="";
        try{
        	$person->delete();
        	$message= trans('appstrings.item_removed', ['item' => $person->full_name]);
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
        
        Session::flash('message', $message);        
        
        return redirect()->route('admin.commoncrud.index');
    }
}
