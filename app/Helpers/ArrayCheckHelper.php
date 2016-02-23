<?php
namespace Hospms\Helpers;

class ArrayCheckHelper{
	
	public static function ignoreRepeated($data, $prefix){
		$items= array();
		$wtf=array();
		foreach($data as $key => $val){$wtf[]=$key;
			if(preg_match("%^". $prefix ."[0-9]+$%", $key) && $val !== "" && $val !== "0" && $key != "0"){
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
		return $items;
	}
}