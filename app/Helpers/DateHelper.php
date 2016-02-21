<?php
namespace Hotpms\Helpers;
class DateHelper{
	
	public static $mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar",
			4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 
			9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");
	
	public static function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {
	
		$dates = array();
		$current = strtotime($first);
		$last = strtotime($last);
	
		while( $current <= $last ) {
	
			$dates[] = date($output_format, $current);
			$current = strtotime($step, $current);
		}
	
		return $dates;
	}
	
	public static function isWeekend($date) {
		return (date('N', strtotime($date)) >= 6);
	}
}