<?php
//include('../header.html');

define('IN_CODE', true);
include('functions_main.php');
include('functions.php');

$id   = request_var('esp_id', 0);
$chan = request_var('esp_channel', 0);
$zone = request_var('esp_zone', 0);
$loca = request_var('esp_location', '');
$level= request_var('esp_rx_level', 0);
$batt = request_var('esp_batt', '');
$time = request_var('esp_rx_time', '');
$date = request_var('esp_rx_date', '');

$time = date('H:i:s', time());
$date = date('H:i:s');

$actives = request_var('esp_actives', 0);

$arr = array(
	'esp_id'		=> isset($id)   ? $id    : '',
	'esp_chan'		=> isset($chan) ? $chan  : '',
	'esp_zone'		=> isset($zone) ? $zone  : '',
	'esp_location'	=> isset($loca) ? $loca  : '',
	'esp_rx_level'	=> isset($level)? $level : '',
	'esp_batt'		=> isset($batt) ? $batt  : '',
	'esp_actives'	=> isset($actives) ? $actives  : '',
	'esp_rx_time'	=> isset($time) ? $time  : 0,
	'esp_rx_date'	=> isset($date) ? $date  : 0,
);

put_data($arr);
//include('../footer.html');