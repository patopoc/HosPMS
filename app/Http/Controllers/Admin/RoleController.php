<?php

namespace Hotpms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hotpms\Http\Requests;
use Hotpms\Http\Controllers\Controller;
use Hotpms\Http\Requests\CreateRateRequest;
use Illuminate\Support\Facades\Session;
use Hotpms\Http\Requests\EditRateRequest;
use Hotpms\Rate;
use Illuminate\Support\Facades\Route;
use Hotpms\Module;
use Hotpms\Role;
use Hotpms\Http\Requests\CreateRoleRequest;
use Hotpms\Http\Requests\EditRoleRequest;

class RoleController extends Controller
{
	public function __construct(){
	
		$this->middleware('access_control');
		$currentRoute= $this->getRouter()->current()->getAction()["as"];
		$this->middleware('set_current_section:'.$currentRoute);
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
    	//install modules by loading controllers into modules table
    	$controllersDirContent= new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator('../app/Http/Controllers'), \RecursiveIteratorIterator::SELF_FIRST);
    	
    	foreach ($controllersDirContent as $key => $val){
    		if(!preg_match('#\\\.{0,2}$#', $key) && preg_match('#\.php$#', $key)){
    			$name= explode('Controllers\\', $key)[1];
    			if(Module::where('name',$name)->first() === null)
    				Module::create(["name" => $name]);
    		}    			
    	}    	

    	$roles= Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {    	
    	
        $role= Role::create($request->all());
        return \Redirect::route('admin.role_details.show', $role->id);
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
        $role= Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRoleRequest $request, $id)
    {
        $role= Role::findOrFail($id);
        $role->fill($request->all());
        $role->save();
        $message= $role->name.' updated successfully';
        if($request->ajax()){
        	return $message;
        }
        Session::flash('message',$message);
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $role= Role::findOrFail($id);
    	$message="";
        try{
        	$role->delete();
        	$message= trans('appstrings.item_removed', ['item' => $role->name]);
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
        return redirect()->route('admin.roles.index');
    }
}
