<?php

namespace Hospms\Http\Middleware;

use Closure;
use Hospms\Menu;

class SetCurrentSection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $currentRoute, $name=null)
    {
    	$menuItem= null;
    	if($name == null){
    		$menuItem= Menu::where('route',$currentRoute)->first();
    	}
    	else{
    		$menuItem= Menu::where('route',$currentRoute)
    						->where('name', $name)
    						->first();
    	}
    	
    	if($menuItem !== null){
    		$section= Menu::findOrFail($menuItem->id_section); 
    		if($section->name == 'toplevel'){
    			session(['current_section' => $menuItem]);
    		}
    		else{
       			session(['current_section' => $section]);
    		}
    	}
        return $next($request);
    }
}
