<?php

namespace Hospms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hospms\Http\Requests;
use Hospms\Http\Controllers\Controller;
use Hospms\Property;
use Hospms\Http\Requests\CreatePropertyRequest;
use Illuminate\Support\Facades\Session;
use Hospms\Http\Requests\EditPropertyRequest;
use Hospms\Helpers\PictureHelper;

class PropertyController extends Controller
{
	private $data;
	public function __construct(){
	
		$this->middleware('access_control');
		$currentRoute= $this->getRouter()->current()->getAction()["as"];
		$this->middleware('set_current_section:'.$currentRoute);
		
		$this->data["langs"]= \DB::table('languages')->lists('name','id');
		$this->data["currencies"]= \DB::table('countries')->where('currency','<>','')->lists('currency','currency_code');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $data= $this->data;
        $data['property']= Property::findOrFail(1);
     
        return view('admin.property.edit', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.property.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePropertyRequest $request)
    {    	
    	$pictures[]= $request->file('logo');
    	$property= Property::create($request->all());
    	if($pictures !== null)
        	PictureHelper::savePictures($pictures, $property, 'logo');
    	
        return \Redirect::route('admin.property.index');
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
        $property= Property::findOrFail($id);
        return view('admin.property.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPropertyRequest $request, $id)
    {
        $property= Property::findOrFail($id);
        $property->fill($request->all());
        $property->save();
        
        if($request->file('logo') !== null){
        	$property->removeLogo();
        	PictureHelper::savePictures([$request->file('logo')], $property,"logo");
        }
        
        $message= $property->name.' updated successfully';
        if($request->ajax()){
        	return $message;
        }
        Session::flash('message',$message);
        
        session('current_property')->load('pictures');
        return redirect()->route('admin.property.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
    	
        /*$property= Property::findOrFail($id);
            $message="";
        
        try{
        	$property->delete();
        	$property->removeLogo();
        	$message= trans('appstrings.item_removed', ['item' => $property->name]);
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
        }Session::flash('message',$message);
        return redirect()->route('admin.property.index');*/
    }
}
