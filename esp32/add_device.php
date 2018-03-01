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
$ip = request_var('ip', '');


if ($action == 'submit' && $ip)
{
/*
	$arr = array(
		'esp_id'			=> $id,
		'esp_ip'			=> $ip,
		'esp_gpio0'			=> request_var('gpio0', 0),
		'esp_gpio1'			=> request_var('gpio1', 0),
		'esp_gpio2'			=> request_var('gpio2', 0),
		'esp_gpio3'			=> request_var('gpio3', 0),
		'esp_gpio4'			=> request_var('gpio4', 0),
		'esp_gpio5'			=> request_var('gpio5', 0),
		'esp_gpio6'			=> request_var('gpio6', 0),
		'esp_gpio7'			=> request_var('gpio7', 0),
		'esp_gpio8'			=> request_var('gpio8', 0),
		'esp_gpio9'			=> request_var('gpio9', 0),
		'esp_gpio10'		=> request_var('gpio10', 0),
		'esp_gpio11'		=> request_var('gpio11', 0),
		'esp_gpio12'		=> request_var('gpio12', 0),
		'esp_gpio13'		=> request_var('gpio13', 0),
		'esp_gpio14'		=> request_var('gpio14', 0),
		'esp_gpio15'		=> request_var('gpio15', 0),
		'esp_gpio16'		=> request_var('gpio16', 0),
 		'esp_gpio17'		=> request_var('gpio17', 0),
 		'esp_gpio18'		=> request_var('gpio18', 0),
 		'esp_gpio19'		=> request_var('gpio19', 0),

		'esp_adc10'			=> request_var('adc10', 0),
		'esp_adc13'			=> request_var('adc13', 0),
		'esp_adc14'			=> request_var('adc14', 0),
		'esp_adc15'			=> request_var('adc15', 0),
		'esp_adc16'			=> request_var('adc16', 0),
		'esp_adc17'			=> request_var('adc17', 0),
		'esp_adc20'			=> request_var('adc20', 0),
		'esp_adc21'			=> request_var('adc21', 0),
		'esp_adc22'			=> request_var('adc22', 0),
		'esp_adc23'			=> request_var('adc23', 0),
		'esp_adc24'			=> request_var('adc24', 0),
		'esp_adc25'			=> request_var('adc25', 0),
		'esp_adc26'			=> request_var('adc26', 0),
		'esp_adc27'			=> request_var('adc27', 0),
		'esp_adc28'			=> request_var('adc28', 0),
		'esp_adc29'			=> request_var('adc29', 0),

		'esp_type'			=> request_var('type', ''),
		'esp_chan'			=> request_var('chan', 0),
		'esp_zone'			=> request_var('zone', 0),
		'esp_location'		=> request_var('location', ''),
		'esp_batt'			=> request_var('batt', ''),
		'esp_actives'		=> request_var('actives', 0),
		'esp_rssi'			=> request_var('rssi', 0),
		'esp_adc_read'		=> request_var('adc_read', ''),
		'esp_adc_trig'		=> request_var('adc_trig', ''),
		'esp_rx_tresh'		=> request_var('adc_rx_tresh', '')
	);
*/
	$arr = array(
		'esp_ip'	=> $ip,
	);
	save_data($arr);
}

include('partial/header.html');
include('partial/left_blocks.html');
include('partial/section_add_form.html');
include('partial/footer.html');