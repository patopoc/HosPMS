<?php

namespace Hotpms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hotpms\Http\Requests;
use Hotpms\Http\Controllers\Controller;
use Hotpms\Booking;
use Hotpms\RoomType;
use Hotpms\Helpers\DateHelper;

class DashboardController extends Controller
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
    	//dd($this->getRouter()->current()->getAction()["as"]);
    	$lastBookings= Booking::where('id_property',session('current_property')->id)
    							->where('status','a')
    							->orderBy('check_in', 'desc')
    							->take(10)
    							->get();
    	$currentOccupiedRooms=count(Booking::where('check_in', '<=',date('Y-m-d'))
    										->where('check_out', '>=', date('Y-m-d'))
    										->where('id_property', session('current_property')->id)
    										->where('status','a')
    										->get());
    	$activeBookings= count(Booking::where('status','a')
    									->where('id_property', session('current_property')->id)
    									->get());
    	$canceledBookings=count(Booking::where('status','c')
    									->where('id_property', session('current_property')->id)
    									->get());
    	$disabledRooms= count(RoomType::where('available',0)
    									->where('id_property', session('current_property')->id)
    									->get());
    	
    	$year= date('Y');
    	
    	$bookingsByMonth= \DB::select('SELECT Month(check_in) as name,count(*) as value 
    									FROM bookings 
    									where id_property='. session('current_property')->id .' and 
    										  check_in >= "'. $year .'-01-01" and 
    										  check_in <= "'. $year .'-12-31"
    									group by Month(check_in)');
    	
    	$biggestValue=0;
    	foreach ($bookingsByMonth as $booking){
    		$booking->name= DateHelper::$mons[$booking->name];
    		if($booking->value > $biggestValue)
    			$biggestValue= $booking->value;
    	}
    	
    	$data['lastBookings']= $lastBookings;
    	$data['occupiedRooms']= $currentOccupiedRooms;
    	$data['activeBookings']= $activeBookings;
    	$data['canceledBookings']= $canceledBookings;
    	$data['disabledRooms']= $disabledRooms;
    	$data['bookingsByMonth']= $bookingsByMonth;
    	$data['biggestValue']= $biggestValue;
    	
        return view('admin.dashboard.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
