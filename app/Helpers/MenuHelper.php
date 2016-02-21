<?php
namespace Hotpms\Helpers;
use Illuminate\Support\Facades\Auth;
use Hotpms\Menu;
use Hotpms\RoleDetail;
class MenuHelper{
	
	public static function create(){
		$roleId= Auth::user()->role->id;
			
		return MenuHelper::getMenuItems($roleId);
	}
	
	public static function getMenuItems($roleId=null){
		$sections= Menu::where('type','section')
						->orderBy('order_index', 'asc')
						->get();
		$menu= array();
		foreach($sections as $section){
			$allowedItemsCount = 0;
			$menuItems= Menu::where('type','item')
							->where('id_section',$section->id)
							->orderBy('order_index', 'asc')
							->get();
			$filteredItems= array();
			foreach($menuItems as $item){
				if($roleId !== null){
					if(self::checkAction($roleId, $item)){
						$filteredItems[]= $item;
						$allowedItemsCount ++;
					}
				}
				else{
					$filteredItems[]= $item;	
					$allowedItemsCount ++;
				}
			}
			//Only show section when there are items to display 
			if($allowedItemsCount > 0 || $roleId === null)
				$menu[]= ['section' => $section, 'items' => $filteredItems];
		}
		//dd($menu);
		return $menu;
	}
	
	private static function checkAction($roleId, $item){
		
		//if($item->id_module == 0 )
		//	return true;
		
		$roleDetail= RoleDetail::where('id_role', $roleId)
								->where('id_module', $item->id_module)
								->first();
		if($roleDetail !== null){
			
			if($item->action === 'index' || $item->action === 'show'){
		
				if ($roleDetail->mod_show == 0){
					return false;
				}
				else 
					return true;
			}
			else if($item->action === 'create' || $item->action === 'store'){
		
				if ($roleDetail->mod_insert == 0){
					return false;
				}
				else 
					return true;
			}
			else if($item->action === 'edit' || $item->action === 'update'){
				 
				if ($roleDetail->mod_update == 0){
					return false;
				}
				else 
					return true;
			}
			else if($item->action === 'delete'){
				 
				if ($roleDetail->mod_delete == 0){
					return false;
				}
				else 
					return true;
			}
		}
		return false;
		
	}
}