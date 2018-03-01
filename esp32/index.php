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

if(!defined('IN_CODE')) define('IN_CODE', true);

$root_path = (defined('ROOT_PATH')) ? ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($root_path . 'common.' . $phpEx);
include($root_path . 'includes/functions_main.' . $phpEx);
include($root_path . 'includes/functions.' . $phpEx);

$page = request_var('page', 0);

if (isset($auth) && $auth == 1)
{
	include('partial/header.html');

	switch($page)
	{
		case 1:	include('partial/partial_info1.html');
		break;
		case 2:	include('partial/partial_info2.html');
		break;
		case 3:	include('partial/partial_info3.html');
		break;
		case 4:	include('partial/partial_info4.html');
		break;
		default:include('partial/section_index.html');
	}

	include('partial/footer.html');
}
else
{
	$submit = request_var('submit', '');
	if ($submit)
	{
		$user = request_var('user', '');
		$pass = request_var('pass', '');
		check_login($user, $pass);
	}
	else
	{
		header('Location: login.php');
	}
}

