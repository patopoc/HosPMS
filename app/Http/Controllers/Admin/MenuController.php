<?php

namespace Hotpms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Hotpms\Http\Requests;
use Hotpms\Http\Controllers\Controller;
use Hotpms\Helpers\MenuHelper;
use Hotpms\Module;
use Hotpms\Menu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
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
    	$menu= MenuHelper::getMenuItems();
    	return view('admin.menus.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['modules']= \DB::table('modules')->lists('name', 'id');
        $data['menuSections']= \DB::table('menu')->where('type','section')->lists('name','id');
        $data['routes']= $this->getAvailableRoutes();
        return view('admin.menus.create', compact('data'));
    }
    
    private function getAvailableRoutes(){
    	$routeList= array();
    	foreach (Route::getRoutes() as $route){
    		if($route->getName() !== null)
    			$routeList[$route->getName()] = $route->getName();
    	}
    	
    	return($routeList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Menu::create($request->all());
        
        return redirect()->route('admin.menus.index');
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
    	$data['menuItem']= Menu::findOrFail($id);
    	$data['modules']= \DB::table('modules')->lists('name', 'id');
    	$data['menuSections']= \DB::table('menu')->where('type','section')->lists('name','id');
    	$data['routes']= $this->getAvailableRoutes();
    	return view('admin.menus.edit', compact('data'));
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
        $menuItem= Menu::findOrFail($id);
        $menuItem->fill($request->all());
        $menuItem->save();
        
        $message= $menuItem->name. ' updated successfully';
        
        if($request->ajax()){
        	return $message;
        }
        
        Session::flash('message', $message);        
        
        return redirect()->route('admin.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $menuItem= Menu::findOrFail($id);
        if($menuItem->type == "section"){
        	$items= Menu::where('id_section', $menuItem->id)->get();
        	if($items !== null){
        		foreach($items as $item)
        			$item->delete();
        	}
        }
        
        $menuItem->delete();
        
        $message= $menuItem->name. ' removed successfully';
        
        if($request->ajax()){
        	return $message;
        }
        
        Session::flash('message', $message);        
        
        return redirect()->route('admin.menus.index');
    }
}
