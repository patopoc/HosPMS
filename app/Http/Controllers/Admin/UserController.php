<?php

namespace Hotpms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hotpms\Http\Requests;
use Hotpms\Http\Controllers\Controller;
use Hotpms\User;
use Hotpms\Country;
use Hotpms\Person;
use Hotpms\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Session;
use Hotpms\Http\Requests\EditUserRequest;
use Hotpms\Helpers\ArrayCheckHelper;

class UserController extends Controller
{
	private $data=null;
	public function __construct(){
	
		$this->middleware('access_control');
		$currentRoute= $this->getRouter()->current()->getAction()["as"];
		$this->middleware('set_current_section:'.$currentRoute);
		
		$properties= \DB::table('property_settings')->lists('name','id');
		
		//property array but formatted for better use inside javascript
		$propArray[]= array(
				"key" => 0,
				"val" => "Select Property"
		);
		foreach ($properties as $key => $val){
			$propArray[]= [
				"key" => $key,
				"val" => $val,					
			];
		}
		$data['properties']= $properties;
		$data['propertiesJson']= $propArray;
		$data['countries']= \DB::table('countries')->lists('name', 'country_code');
		$data['roles']= \DB::table('roles')->lists('name', 'id');
		$this->data= $data;	
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   		$users= User::all();
   		
   		return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$data= $this->data;
    	return view('admin.users.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {    	
    	
    	$propertyKeys= array();
    	
    	$propertyKeys= ArrayCheckHelper::ignoreRepeated($request->all(), "property");
			
    	/*foreach($request->all() as $key => $val){
    		if(preg_match("%^property[0-9]+$%", $key) && $val !== ""){
    			//check that a value doesn't repeat
    			$repeatedProperty= false;
    			foreach($propertyKeys as $propertyKey){
    				if($val == $propertyKey){
    					$repeatedProperty=true;
    					break;
    				}
    			}
    			if(!$repeatedProperty)
    				$propertyKeys[]= $val;
    		}
    	}   */ 	
    	
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
        
        $user= User::create([
        		'id_person'=> $person->id,
        		'id_role' => $request->get('id_role'),
        		'default_property' => $propertyKeys[0],
        		'auth_key' => 'some key',
        		'username' => $request->get('username'),
        		'password' => $request->get('password'),
        		
        ]);
        
        $user->properties()->attach($propertyKeys);
        
		return \Redirect::route('admin.users.index');
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
        $user = User::findOrFail($id);
        $data= $this->data;
        $data['user']= $user;
		return view('admin.users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
    	$propertyKeys= ArrayCheckHelper::ignoreRepeated($request->all(), "property");
    	$person= Person::where('ci',$request->get('ci'))->get()->first();
    	$person->fill([
    			'ci' => $request->get('ci'),
    			'name' => $request->get('name'),
    			'last_name' => $request->get('last_name'),
    			'email' => $request->get('email'),
    			'telephone' => $request->get('telephone'),
    			'id_country' => $request->get('id_country'),
    	]);
    	$person->save();
    	
        $user = User::findOrFail($id);
		$user->fill([
        		'id_person'=> $person->id,
        		'id_role' => $request->get('id_role'),
        		'default_property' => $request->get('default_property'),
        		'auth_key' => 'some key',
        		'username' => $request->get('username'),
        		'password' => $request->get('password'),
        		
        ]);
		$user->save();
		
		$user->properties()->sync();
		
		$message= $user->username . ' updated successfully';
		if($request->ajax()){
			return $message;
		}
		
		Session::flash('message', $message);
		
		return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::findOrFail($id);
		
    	$message="";
        try{
        	$user->delete();
        	$message= trans('appstrings.item_removed', ['item' => $user->username]);
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
		
		return redirect()->route('admin.users.index');
    }
}
