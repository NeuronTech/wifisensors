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
		'esp_rx_tresh'		=> request_var('tresh', ''),
	);
	save_data($arr);
	meta_refresh(0, 'index.php?esp_id=' . request_var('esp', 0));
}
else
{
	$id = request_var('esp_id', 0);
	$json_array = get_data($id);
}

include('header.html');
include('left_blocks.html');
include('section_form.html');
include('footer.html');
