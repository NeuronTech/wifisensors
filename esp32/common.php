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

$hostname = "localhost";
$database = "esp-server";

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
	header('Location: login.php');
}

$record_array[] = array(
	'esp_ip'		=> "000.000.000.000",
	'esp_gpio0'		=> 0,
	'esp_gpio1'		=> 0,
	'esp_gpio2'		=> 0,
	'esp_gpio3'		=> 0,
	'esp_gpio4'		=> 0,
	'esp_gpio5'		=> 0,
	'esp_gpio6'		=> 0,
	'esp_gpio7'		=> 0,
	'esp_gpio8'		=> 0,
	'esp_gpio9'		=> 0,
	'esp_gpio10'	=> 0,
	'esp_gpio11'	=> 0,
	'esp_gpio12'	=> 0,
	'esp_gpio13'	=> 0,
	'esp_gpio14'	=> 0,
	'esp_gpio15'	=> 0,
	'esp_gpio16'	=> 0,
	'esp_adc11'		=> 0,
	'esp_adc13'		=> 0,
	'esp_adc14'		=> 0,
	'esp_adc15'		=> 0,
	'esp_adc16'		=> 0,
	'esp_adc17'		=> 0,
	'esp_adc20'		=> 0,
	'esp_adc21'		=> 0,
	'esp_adc22'		=> 0,
	'esp_adc23'		=> 0,
	'esp_adc24'		=> 0,
	'esp_adc25'		=> 0,
	'esp_adc26'		=> 0,
	'esp_adc27'		=> 0,
	'esp_adc28'		=> 0,
	'esp_adc29'		=> 0,
	'esp_actives'	=> 0,
	'esp_type'		=> 0,
	'esp_zone'		=> 0,
	'esp_rssi'  	=> 0.0,
	'esp_adc_read'	=> 0.0,
	'esp_adc_trig'	=> 0.0,
	'esp_batt'		=> 0.0,
	'esp_rx_time'	=> date('H:i:s', time()),
	'esp_rx_date'	=> date('H:i:s', time()),
	'esp_location'	=> "",
);

