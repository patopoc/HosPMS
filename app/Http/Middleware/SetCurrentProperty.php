<?php

namespace Hotpms\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Hotpms\Property;


class SetCurrentProperty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	
    	if(! $request->session()->has('current_property')){
    		if(Auth::user()->username == 'admin'){
    			$properties= Property::all();
    			Auth::user()->properties()->sync($properties);
    			$request->session()->put('current_property', $properties[0]);
    		}
    		else{
		    	$property= Property::findOrFail(Auth::user()->default_property);
		    	$request->session()->put('current_property', $property);
    		}
    	}
    	
    	if(!$request->session()->has('available_properties')){
    		if(count(Auth::user()->properties) > 1){
    			$request->session()->put('available_properties', Auth::user()->properties);
    		}
    	}
    	
    	if($request->has('current_property')){
    		$property= Property::find($request->get('current_property'));
    		if($property !== null)
    			$request->session()->put('current_property', $property);
    	}
    	
        return $next($request);
    }
}
