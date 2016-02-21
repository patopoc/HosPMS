<?php

namespace Hotpms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Hotpms\Http\Requests;
use Hotpms\Http\Controllers\Controller;
use Hotpms\Booking;
use Illuminate\Database\Eloquent\Model;
use Hotpms\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Hotpms\Helpers\DateHelper;


class BookingController extends Controller
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
    	$data= array();
    	if($request->has('reference_code')){
    		$data['bookings']= Booking::where('status','a')
    									->where('reference_code', $request->get('reference_code'))    									
							    		->where('id_property', session('current_property')->id)
							    		->paginate(2);
    	}
    	else{
	        $data['bookings']= Booking::where('status','a')
	        					->where('id_property', session('current_property')->id)
	        					->paginate(2);
    	}
	    $data['status']= 'a';
        return view('admin.booking.index',compact('data'));
        
    }

    public function canceled(){
    	$data['bookings']= Booking::where('status','c')
        					->where('id_property', session('current_property')->id)
        					->get();
        $data['status']= 'c';
        return view('admin.booking.index',compact('data'));
    }
    
    public function arrival(){
    	$data['today']= Booking::where('check_in',date('Y/m/d'))
        					->where('id_property', session('current_property')->id)
        					->get();
    	$data['tomorrow']= Booking::where('check_in',date('Y/m/d', strtotime('+1 day')))
        					->where('id_property', session('current_property')->id)
        					->get();
    	$data['status']= 'a';
    	return view('admin.booking.index',compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {       	
    	if($request->has("date"))
    		$data["date"]= $request->get("date");
    	if($request->has("room"))
    		$data["room"]= $request->get("room");
    	
    	//$data['properties']= \DB::table('property_settings')->lists('name','id');
    	$data['countries']= \DB::table('countries')->lists('name', 'country_code');
    	$currentProperty= $request->session()->get('current_property')->id;
    	$data['room_types']= \DB::table('room_types')->where('id_property', $currentProperty)
    												->where('available',1)
    												->lists('name', 'id');
    	$data['rate_plans']= \DB::table('rates')->lists('name', 'id');
    	
    	$data['disabledDates']= json_encode($this->getDisabledDates());
        return view('admin.booking.create', compact('data'));
    }
    
    private function getDisabledDates(){
    	$dates= \DB::table('bookings')->where('id_property', session('current_property')->id)->lists('check_out', 'check_in');
    	$disabledDates= array();
    	foreach ($dates as $checkIn => $checkOut){
			$disabledDates= array_merge($disabledDates, DateHelper::date_range($checkIn, $checkOut));    		
    	}
    	return $disabledDates;
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->checkAvailability($request);
    	
    	//dd(Person::where('ci',$request->get('ci')));
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
        
    	$booking= new Booking([
        		'id_property' => session('current_property')->id,
        		'id_user' => Auth::user()->id,
        		'person' => $person->id,
        		'date' => date("Y/m/d"),
        		'check_in' => $request->get('check_in'),
        		'check_out' => $request->get('check_out'),
        		'arrival_time' => $request->get('arrival_time'),
        		'comments_and_requests' => $request->get('comments_and_requests'),
        		'id_room_type' => $request->get('id_room_type'),
        		'number_of_rooms' => $request->get('number_of_rooms'),
        		'adults' => $request->get('adults'),
        		'children' => $request->get('children'),
        		'pets' => $request->get('pets'),
        		'rate_plan' => $request->get('rate_plan'), 		
        		
        		]);
        
        $reference_code;
        do{
        	$reference_code= str_random(10);
        }while(count(Booking::where('reference_code',$reference_code)->get()) > 0);
        $booking->reference_code= $reference_code;
        $booking->save();
        //$booking->roomType->occupied= 1;               
        
        return redirect()->route('admin.booking.index');
    }

    private function checkAvailability($request, $id=null){
    	$booking= Booking::where("id_room_type", $request->get("id_room_type"))
        					->where('id_property', session('current_property')->id)        					
    						->where("check_in",">=", $request->get("check_in"))
    						->where("check_in","<=", $request->get("check_out"))
    						->first();
    	if($booking !== null && $booking->id != $id){
	    	$message= "Room already reserved for given dates";
	    	if($request->ajax()){
	    		return $message;
	    	}
	    	Session::flash('message',$message);
	    	return redirect()->route('admin.booking.create');
    	}
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['booking']= Booking::findOrFail($id);
        $data['countries']= \DB::table('countries')->lists('name', 'country_code');
        $currentProperty= session('current_property')->id;
        $data['room_types']= \DB::table('room_types')->where('id_property', $currentProperty)
											        ->where('available',1)											        
											        ->lists('name', 'id');
        $data['rate_plans']= \DB::table('rates')->lists('name', 'id');         
        $data['disabledDates']= json_encode($this->getDisabledDates());
        
        return view('admin.booking.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$this->checkAvailability($request, $id);
    	
    	if(count(Person::where('ci',$request->get('ci'))->get()) == 0){
    		$message= "You can not change the owner of this booking. You must create a new booking instead";
    		if($request->ajax()){
    			return $message;
    		}
    		Session::flash('message',$message);
    		return redirect()->route('admin.booking.edit');
    	}
    	 
    	$person= Person::where('ci',$request->get('ci'))->get()->first();
    	$person->fill([    				
    				'name' => $request->get('name'),
    				'last_name' => $request->get('last_name'),
    				'email' => $request->get('email'),
    				'telephone' => $request->get('telephone'),
    				'id_country' => $request->get('id_country'),
    		]);
    	$person->save();
    	$booking= Booking::findOrFail($id);
    	//$booking->roomType->occupied= 0;
    	$booking->fill([
    			'id_property' => session('current_property')->id,
    			'id_user' => Auth::user()->id,
    			'person' => $person->id,
    			'date' => date("Y/m/d"),
    			'check_in' => $request->get('check_in'),
    			'check_out' => $request->get('check_out'),
    			'arrival_time' => $request->get('arrival_time'),
    			'comments_and_requests' => $request->get('comments_and_requests'),
    			'id_room_type' => $request->get('id_room_type'),
    			'number_of_rooms' => $request->get('number_of_rooms'),
    			'adults' => $request->get('adults'),
    			'children' => $request->get('children'),
    			'pets' => $request->get('pets'),
    			'rate_plan' => $request->get('rate_plan'),
    	
    	]);
    	$booking->save();
    	//$booking->roomType->occupied= 1;
    	$message= "Booking " . $booking->reference_code . ' updated succesfully';
    	if($request->ajax()){
    		return $message;
    	}
    	Session::flash('message',$message);    	
    	
    	return redirect()->route('admin.booking.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //It doesn't destroy but rather cancel the booking
        $booking= Booking::findOrFail($id);
        $booking->status='c';
        $booking->save();
        
        $message= "Booking " . $booking->reference_code . ' removed succesfully';
        if($request->ajax()){
        	return $message;
        }
        Session::flash('message',$message);
                
        return redirect()->route('admin.booking.index');
    }
}
