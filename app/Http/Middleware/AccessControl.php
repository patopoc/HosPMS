<?php

namespace Hotpms\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Hotpms\Module;
use Hotpms\RoleDetail;


class AccessControl
{
	private $auth;
	public function __construct(Guard $auth){
		$this->auth= $auth;
	}
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$actions=array();
    	//Get the controller and the action from the route
    	$controller= explode("@", $request->route()->getActionName());
    	$controllerName= explode('Controllers\\',$controller[0])[1] . ".php";
    	$controllerAction= $controller[1];
    	
    	//find module with the same name of the controller
    	$module= Module::where('name', $controllerName)->first();
    	
    	//Get the role detail for the corresponing user role and module
    	$roleDetail= RoleDetail::where('id_role', $this->auth->user()->role->id)
    							->where('id_module', $module->id)
    							->first();
    	//Check if action is allowed according to roleDetails mod_show, mod_insert, mod_update, mod_delete
    	
    	$this->checkAction($controllerAction, $roleDetail, $request);    	
    	
        return $next($request);
    }
    
    private function checkAction($action, $roleDetail, $request){
    	if($roleDetail === null){
    		if($request->ajax()){
    			return response('Unauthorized.',401);
    		}
    		return redirect()->to('auth/login');    		
    	}
    	
    	if($action === 'index' || $action === 'show'){
    		
    		if ($roleDetail->mod_show == 0){
    			$this->auth->logout();
    			if($request->ajax()){
    				return response('Unauthorized.',401);
    			}
    			else{
    				return redirect()->to('auth/login');
    			}
    		}    	
    	}
    	else if($action === 'create' || $action === 'store'){
    		
    		if ($roleDetail->mod_insert == 0){
    			$this->auth->logout();
    			if($request->ajax()){
    				return response('Unauthorized.',401);
    			}
    			else{
    				return redirect()->to('auth/login');
    			}
    		}    	
    	}
    	else if($action === 'edit' || $action === 'update'){
    	
    		if ($roleDetail->mod_update == 0){
    			$this->auth->logout();
    			if($request->ajax()){
    				return response('Unauthorized.',401);
    			}
    			else{
    				return redirect()->to('auth/login');
    			}
    		}
    	}
    	else if($action === 'delete'){
    	
    		if ($roleDetail->mod_delete == 0){
    			$this->auth->logout();
    			if($request->ajax()){
    				return response('Unauthorized.',401);
    			}
    			else{
    				return redirect()->to('auth/login');
    			}
    		}
    	}
    }
}
