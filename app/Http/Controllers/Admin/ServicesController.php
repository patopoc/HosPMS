<?php

namespace Hotpms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hotpms\Http\Requests;
use Hotpms\Http\Controllers\Controller;
use Hotpms\Http\Requests\CreateServiceRequest;
use Illuminate\Support\Facades\Session;
use Hotpms\Http\Requests\EditServiceRequest;
use Hotpms\Service;

class ServicesController extends Controller
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
        $services= Service::all();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServiceRequest $request)
    {   	
    	
        Service::create($request->all());
        return \Redirect::route('admin.services.index');
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
        $service= Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditServiceRequest $request, $id)
    {
        $service= Service::findOrFail($id);
        $service->fill($request->all());
        $service->save();
        
        $message= $service->name.' updated successfully';
        if($request->ajax()){
        	return $message;
        }
        Session::flash('message',$message);
        return redirect()->route('admin.services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $service= Service::findOrFail($id);
    	
        $message="";
        try{
        	$service->delete();
        	$message= trans('appstrings.item_removed', ['item' => $service->name]);
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
        return redirect()->route('admin.services.index');
    }
}
