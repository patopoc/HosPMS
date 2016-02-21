<?php
namespace Hotpms\Helpers;

class ArrayCheckHelper{
	
	public static function ignoreRepeated($data, $prefix){
		$items= array();
		
		foreach($data as $key => $val){
			if(preg_match("%^". $prefix ."[0-9]+$%", $key) && $val !== "" && $key != 0){
				
				//check that a value doesn't repeat
				$repeatedVal= false;
				foreach($items as $item){
					if($val == $item){
						$repeatedVal=true;
						break;
					}
				}
				if(!$repeatedVal)
					$items[]= $val;
			}
		}
		//dd($items);
		return $items;
	}
}