<?php

namespace Hotpms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hotpms\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Hotpms\Module;
use Hotpms\Role;
use Hotpms\RoleDetail;

class RoleDetailController extends Controller
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
    public function index(Request $request)
    {    	
    	
    	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    	
    	$roleId= $request->get('role-id');
    	
    	foreach($request->all() as $key => $val){
    		//condider only the checkboxes
    		if($key !== '_token' && $key !== 'role-id'){

    			$roleDetail= RoleDetail::firstOrNew(['id_role' => $roleId, 'id_module' => $key]);
    			 
    			$modActions= $this->getActionsArray($val);
				
    			$roleDetail->fill([
    				'mod_show' => $modActions['mod_show'],
		    		'mod_insert' => $modActions['mod_insert'],
		    		'mod_update' => $modActions['mod_update'],
		    		'mod_delete' => $modActions['mod_delete'],
    			]);
    			$roleDetail->save();    			 
    			
    		}
    	}
    	
        //Rate::create($request->all());
        return \Redirect::route('admin.roles.index');
    }

    private function getActionsArray($actionRequest){
    	$actions=array(
    		'mod_show' => 0,
    		'mod_insert' => 0,
    		'mod_update' => 0,
    		'mod_delete' => 0,
    	);
    	foreach($actionRequest as $action){
    		if($action !== "")
    			$actions[$action] = 1;
    	}
    	return $actions;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	
    	$data['role']= Role::find($id);
    	$data['modules']= Module::all();
    	
    	//dd($data['role']->roleDetails->where('id_module',137)->first()->module->name);
    	
        return view('admin.role_details.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rate= Rate::findOrFail($id);
        return view('admin.rate.edit', compact('rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRateRequest $request, $id)
    {
        $rate= Rate::findOrFail($id);
        $rate->fill($request->all());
        $rate->save();
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $rate= Rate::findOrFail($id);
        $rate->delete();
        $message= "La propiedad ".$rate->name.' fue eliminada';
        if($request->ajax()){
        	return $message;
        }
        Session::flash('message',$message);
        return redirect()->route('admin.rate.index');
    }
}
