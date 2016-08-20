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

$auth = $_SESSION['auth'];
$user = $_SESSION['user'];

//echo 'auth = [' . $auth . ']';
//echo 'user = [' . $user . ']';

if (isset($auth) && $auth == 1)
{
	//echo '<br />' . $_SESSION['user'];// var_dump($_SESSION['user']);
	//echo '<br />' . $_SESSION['auth'];// var_dump($_SESSION['auth']);

	include('header.html');
	include('left_blocks.html');
	include('section_index.html');
	include('footer.html');
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

