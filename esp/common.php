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

$root_path = (defined('ROOT_PATH')) ? ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

if (file_exists($root_path . 'config.' . $phpEx))
{
	require($root_path . 'config.' . $phpEx);
}

if (!session_start())
{
	echo 'Error setting up sessions!';
}

$_SESSION['user'] = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$_SESSION['auth'] = isset($_SESSION['auth']) ? $_SESSION['auth'] : '';

if (isset($_SESSION['auth']))
{
	$user = $_SESSION['user'];
	$auth = $_SESSION['auth'];
}
else
{
	$auth = 0;
	$user = '';
	echo 'No Session Info';
}

?>