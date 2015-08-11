<?php
//include('../header.html');

define('IN_CODE', true);
include('functions_main.php');
include('functions.php');

$id			= request_var('esp_id', 0);
$chan		= request_var('esp_channel', 0);
$zone		= request_var('esp_zone', 0);
$loca		= request_var('esp_location', '');
$level		= request_var('esp_rx_level', 0);
$batt		= request_var('esp_batt', '');
$actives	= request_var('esp_actives', 0);

$arr = array(
	'esp_id'			=> isset($id)   ? $id    : 0,
	'esp_chan'			=> isset($chan) ? $chan  : 0,
	'esp_zone'			=> isset($zone) ? $zone  : 0,
	'esp_location'		=> isset($loca) ? $loca  : '',
	'esp_rx_level'		=> isset($level)? $level : 0,
	'esp_batt'			=> isset($batt) ? $batt  : 0,
	'esp_actives'		=> isset($actives) ? $actives  : 0,
);

put_data($arr);
//include('../footer.html');