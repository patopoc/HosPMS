<?php

namespace Hotpms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hotpms\Http\Requests;
use Hotpms\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Hotpms\BedType;
use Hotpms\Http\Requests\CreateBedTypeRequest;
use Hotpms\Http\Requests\EditBedTypeRequest;

class BedTypeController extends Controller
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
        $bed_types= BedType::all();
        return view('admin.bed_types.index', compact('bed_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bed_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBedTypeRequest $request)
    {    	
    	
        BedType::create($request->all());
        return \Redirect::route('admin.bed_types.index');
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
        $bed_type= BedType::findOrFail($id);
        return view('admin.bed_types.edit', compact('bed_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditBedTypeRequest $request, $id)
    {
        $bedtype= BedType::findOrFail($id);
        $bedtype->fill($request->all());
        $bedtype->save();
        
        $message= "Booking " . $bedtype->type . ' updated succesfully';
        if($request->ajax()){
        	return $message;
        }
        Session::flash('message',$message);
         
        return redirect()->route('admin.bed_types.index');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $bedtype= BedType::findOrFail($id);
    	$message="";
        
        try{
        	$bedtype->delete();
        	$message= trans('appstrings.item_removed', ['item' => $bedtype->type]);
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
        return redirect()->route('admin.bed_types.index');
    }
}
