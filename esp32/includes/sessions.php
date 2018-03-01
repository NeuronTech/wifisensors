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

function session_begin()
{
	if (!$auth)
	{
		//$pass = '';
		//$user = '';
		//include('database.php');
		//$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
		//$selected = mysqli_select_db($dbhandle, "esp-server.login");
		//$user = $_SESSION['user'];
		//$auth = $_SESSION['auth'];
	}
	else
	{
		$auth = true;
	}
}

?>