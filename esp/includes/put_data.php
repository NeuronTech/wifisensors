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
//include('../header.html');

define('IN_CODE', true);
include('functions_main.php');
include('functions.php');

$id			= request_var('id', 0);
var_dump($id);

$ip 		= request_var('esp_ip', '');
$loca		= request_var('esp_location', '');
$type		= request_var('esp_type', '');
$zone		= request_var('esp_zone', 0);
$actives	= request_var('esp_actives', 0);
$batt		= request_var('esp_batt', 0.00);

$gpio0		= request_var('esp_gpio0',  0);
$gpio1		= request_var('esp_gpio1',  0);
$gpio2		= request_var('esp_gpio2',  0);
$gpio3		= request_var('esp_gpio3',  0);
$gpio4		= request_var('esp_gpio4',  0);
$gpio5		= request_var('esp_gpio5',  0);
$gpio9		= request_var('esp_gpio9',  0);
$gpio10		= request_var('esp_gpio10', 0);
$gpio12		= request_var('esp_gpio12', 0);
$gpio13		= request_var('esp_gpio13', 0);
$gpio14		= request_var('esp_gpio14', 0);
$gpio15		= request_var('esp_gpio15', 0);
$gpio16		= request_var('esp_gpio16', 0);

$rssi		= request_var('esp_rssi', 0);
$adc		= request_var('esp_adc', 0);
$adc_reading	= request_var('esp_adc_reading', 0);
$adc_trigger	= request_var('esp_adc_trigger', 0);


$arr = array(
	'id'			=> isset($id)		? $id    : 0,
	'esp_ip'		=> isset($ip)		? $ip    : '',
	'esp_type'		=> isset($type)		? $type  : '',
	'esp_location'	=> isset($loca)		? $loca  : '',
	'esp_zone'		=> isset($zone)		? $zone  : 0,
	'esp_batt'		=> isset($batt)		? $batt  : 0,
	'esp_actives'	=> isset($actives)	? $actives  : 0,

	'esp_gpio0'		=> isset($gpio0)	? $gpio0  : -1,
	'esp_gpio1'		=> isset($gpio1)	? $gpio1  : -1,
	'esp_gpio2'		=> isset($gpio2)	? $gpio2  : -1,
	'esp_gpio3'		=> isset($gpio3)	? $gpio3  : -1,
	'esp_gpio4'		=> isset($gpio4)	? $gpio4  : -1,
	'esp_gpio5'		=> isset($gpio5)	? $gpio5  : -1,
	'esp_gpio9'		=> isset($gpio9)	? $gpio9  : -1,
	'esp_gpio10'	=> isset($gpio10)	? $gpio10 : -1,
	'esp_gpio12'	=> isset($gpio12)	? $gpio12 : -1,
	'esp_gpio13'	=> isset($gpio13)	? $gpio13 : -1,
	'esp_gpio14'	=> isset($gpio14)	? $gpio14 : -1,
	'esp_gpio15'	=> isset($gpio15)	? $gpio15 : -1,
	'esp_gpio16'	=> isset($gpio16)	? $gpio16 : -1,

	'esp_rssi'		=> isset($rssi)		? $rssi : 0,
	'esp_adc'		=> isset($adc)		? $adc  : 0,
	'esp_adc_reading'	=> isset($adc_reading)	? $adc_reading  : 0,
	'esp_adc_trigger'	=> isset($adc_trigger)? $adc_trigger : 0,
);

put_data($arr);
//include('../footer.html');