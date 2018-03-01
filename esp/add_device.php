<?php

/**
*
* @package ESP8266 Web Server
* @version $Id$
* @author  Michael O'Toole - aka michaelo
* @begin   Saturday, Jan 22, 2015
* @copyright (c) 2015 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

define('IN_CODE', true);

$root_path = (defined('ROOT_PATH')) ? ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($root_path . 'common.' . $phpEx);
include($root_path . 'includes/functions_main.' . $phpEx);
include($root_path . 'includes/functions.' . $phpEx);

if (!$auth)
{
	header('Location: login.php');
}

$action = request_var('action', '');

if ($action == 'submit')
{
	$id = request_var('id', 0);

	$arr = array(
		'esp_ip'			=> request_var('ip', ''),
		'esp_gpio0'			=> request_var('gpio0', 0),
		'esp_gpio1'			=> request_var('gpio1', 0),
		'esp_gpio2'			=> request_var('gpio2', 0),
		'esp_gpio3'			=> request_var('gpio3', 0),
		'esp_gpio4'			=> request_var('gpio4', 0),
		'esp_gpio5'			=> request_var('gpio5', 0),
		'esp_gpio9'			=> request_var('gpio9', 0),
		'esp_gpio10'		=> request_var('gpio10', 0),
		'esp_gpio12'		=> request_var('gpio12', 0),
		'esp_gpio13'		=> request_var('gpio13', 0),
		'esp_gpio14'		=> request_var('gpio14', 0),
		'esp_gpio15'		=> request_var('gpio15', 0),
		'esp_gpio15'		=> request_var('gpio16', 0),
		'esp_type'			=> request_var('type', ''),
		'esp_chan'			=> request_var('chan', 0),
		'esp_zone'			=> request_var('zone', 0),
		'esp_location'		=> request_var('location', ''),
		'esp_batt'			=> request_var('batt', ''),
		'esp_actives'		=> request_var('actives', 0),

		'esp_rssi'			=> request_var('rssi', 0),
		'esp_adc'			=> request_var('adc', 0),
		'esp_acp_read'		=> request_var('adc_reading', ''),
		'esp_acp_value'		=> request_var('adc_trigger', ''),
	);
	save_data($arr);
	meta_refresh(0, 'edit.php?esp_id=' . $esp);
}

//esp_gpios +=

/*
$action = request_var('action', '');

if ($action == 'submit')
{
	$arr = array(
		'esp_id'			=> request_var('esp', 0),
		'esp_chan'			=> request_var('chan', 0),
		'esp_zone'			=> request_var('zone', 0),
		'esp_location'		=> request_var('location', ''),
		'esp_rx_level'		=> request_var('level', 0),
		'esp_batt'			=> request_var('batt', ''),
		'esp_actives'		=> request_var('actives', 0),
		'esp_rx_treshold'	=> request_var('tresh', ''),
	);
	save_data($arr);
	meta_refresh(0, 'edit.php?esp_id=' . request_var('esp', 0));
}
else
{
	$id = request_var('esp_id', 0);
	$json_array = get_data($id);
}
*/

include('header.html');
include('left_blocks.html');
include('section_add_form.html');
include('footer.html');