<?php

namespace Hotpms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hotpms\Http\Requests;
use Hotpms\Http\Controllers\Controller;
use Hotpms\Person;
use Illuminate\Support\Facades\Session;
use Webpatser\Countries\Countries;
use Hotpms\Http\Requests\CreatePersonRequest;
use Hotpms\Http\Requests\EditPersonRequest;
use Illuminate\Database\QueryException;


class PeopleController extends Controller
{
	
	public $countriesShortList;
	
	public function __construct(){
		
		$this->middleware('access_control');
		$currentRoute= $this->getRouter()->current()->getAction()["as"];
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
    	if($request->has('name')){
			$people= Person::name($request->get('name'))->paginate(10);    	
    	}
    	else{
			$people= Person::paginate(5);
    	}
		return view('admin.people.index', compact('people'));		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    	   	
    	$data['countries']= $this->countriesShortList;
    	return view('admin.people.create', compact('data'));
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
        
        return \Redirect::route('admin.people.index');
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
        $data["person"]= Person::findOrFail($id);
        $data["countries"]= $this->countriesShortList;
        
        
        return view('admin.people.edit', compact('data'));
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
        
        return redirect()->route('admin.people.index');
  
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
        
        return redirect()->route('admin.people.index');
    }
}
