<?php
namespace Hospms\Helpers;

class DebugHelper{
	public static function log($msg){
		echo "<script>console.log(". $msg .")</script>";
	}
}