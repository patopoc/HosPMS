<?php

namespace Hotpms\Http\Middleware;

use Closure;
use Hotpms\Menu;

class SetCurrentSection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $currentRoute)
    {
    	$menuItem= Menu::where('route',$currentRoute)->first();
    	
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
