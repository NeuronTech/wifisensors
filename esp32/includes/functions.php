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


/*
	* Functions and their properties (note, I do not wwrite c++ / no classes)...
	* All user entry is sanitized even though we use a local server...
 */

function get_record($id, $ip, $all = false)
{
	global $hostname, $username, $password, $database;

	// global vars are not available when php function are called by javascript so...
	// hard coded her and we need a fix...

	if(!isset($username))
	{
		$username = 'admin';
		$password = 'letmein';
		$hostname = 'localhost';
		$database = 'esp-server';
	}

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $database);

	if(!$selected)
	{
		die("23 Could not select devices");
	}

	if ($all)	// return all record //
	{
		$sql = "SELECT *
			FROM devices
			ORDER BY esp_is_client, esp_location ASC, esp_rx_date DESC, esp_rx_time DESC";

		$result = mysqli_query($dbhandle, $sql);

		while($row = mysqli_fetch_array($result))
		{
			$json_arrays[] = array(
				'id'		=> $row['esp_id'],
				'ip'		=> $row['esp_ip'],
				'status'	=> $row['esp_status'],

				'gpio0'		=> $row['esp_gpio0'],
				'gpio1'		=> $row['esp_gpio1'],
				'gpio2'		=> $row['esp_gpio2'],
				'gpio3'		=> $row['esp_gpio3'],
				'gpio4'		=> $row['esp_gpio4'],
				'gpio5'		=> $row['esp_gpio5'],
				'gpio6'		=> $row['esp_gpio6'],
				'gpio7'		=> $row['esp_gpio7'],
				'gpio8'		=> $row['esp_gpio8'],
				'gpio9'		=> $row['esp_gpio9'],
				'gpio10'	=> $row['esp_gpio10'],
				'gpio11'	=> $row['esp_gpio11'],
				'gpio12'	=> $row['esp_gpio12'],
				'gpio13'	=> $row['esp_gpio13'],
				'gpio14'	=> $row['esp_gpio14'],
				'gpio15'	=> $row['esp_gpio15'],
				'gpio16'	=> $row['esp_gpio16'],

				'adc10'		=> $row['esp_adc10'],
				'adc13'		=> $row['esp_adc13'],
				'adc14'		=> $row['esp_adc14'],
				'adc15'		=> $row['esp_adc15'],
				'adc16'		=> $row['esp_adc16'],
				'adc17'		=> $row['esp_adc17'],

				'adc20'		=> $row['esp_adc20'],
				'adc21'		=> $row['esp_adc21'],
				'adc22'		=> $row['esp_adc22'],
				'adc23'		=> $row['esp_adc23'],
				'adc24'		=> $row['esp_adc24'],
				'adc25'		=> $row['esp_adc25'],
				'adc26'		=> $row['esp_adc26'],
				'adc27'		=> $row['esp_adc27'],
				'adc28'		=> $row['esp_adc28'],
				'adc29'		=> $row['esp_adc29'],

				'adc_read'	=> $row['esp_adc_read'],
				'adc_trig'	=> $row['esp_adc_trig'],

				'type'		=> $row['esp_type'],
				'rssi'		=> $row['esp_rssi'],
				'chan'		=> $row['esp_chan'],
				'zone'		=> $row['esp_zone'],
				'time'		=> $row['esp_rx_time'],
				'date'		=> $row['esp_rx_date'],
				'location'	=> $row['esp_location'],
				'batt'		=> $row['esp_batt'],
				'actives'	=> $row['esp_actives'],
				'timenow'	=> date('H:i:s', time()),
			);
		}
		mysqli_free_result($result);
		mysqli_close($dbhandle);
		return($json_arrays);
	}
	else if ($id)	// return record with matching id //
	{
		$sql = "SELECT *
			FROM devices
			WHERE esp_id = '" . $id . "'
			ORDER BY esp_is_client, esp_type, esp_rx_date DESC, esp_rx_time DESC";
		$result = mysqli_query($dbhandle, $sql);
		$row = mysqli_fetch_assoc($result);
	}
	else if ($ip)	// return record with matching ip //
	{
		$sql = "SELECT *
			FROM devices
			WHERE esp_ip = '" . $ip . "'";
		$result = mysqli_query($dbhandle, $sql);
		$row = mysqli_fetch_assoc($result);
	}
	else // return last updated/active record //
	{
		$sql = "SELECT *
			FROM devices
			ORDER BY esp_rx_date DESC, esp_rx_time DESC";
		$result = mysqli_query($dbhandle, $sql);
		$row = mysqli_fetch_assoc($result);
	}
	$json_array = fill_array($row);
	mysqli_free_result($result);
	mysqli_close($dbhandle);
	return($json_array);
}

/*
	Update database if id is valid, else add a new device
 */

function put_data($data)
{
	$new = false;

	if(!isset($username))
	{
		$username = $_SESSION['user'];
		$password = $_SESSION['pass'];
		$hostname = "localhost";
		$database = "esp-server";
	}

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $database);

	if(!$selected)
	{
		die("155 Could not select devices table");
	}

	$id = $data['esp_id'];

	$data['esp_rx_date'] = date("Y-m-d");
	$data['esp_rx_time'] = date('H:i:s', time());
	$alarm = ($data['esp_rssi'] >= $data['esp_rssi']) ? 1 : 0;

	if ($id)
	{
		$sql = "UPDATE devices
			SET
				esp_ip          = '" . $data['esp_ip'] . "',
				esp_gpio0		= '" . $data['esp_gpio0'] . "',
				esp_gpio1		= '" . $data['esp_gpio1'] . "',
				esp_gpio2		= '" . $data['esp_gpio2'] . "',
				esp_gpio3		= '" . $data['esp_gpio3'] . "',
				esp_gpio4		= '" . $data['esp_gpio4'] . "',
				esp_gpio5		= '" . $data['esp_gpio5'] . "',
				esp_gpio6		= '" . $data['esp_gpio6'] . "',
				esp_gpio7		= '" . $data['esp_gpio7'] . "',
				esp_gpio8		= '" . $data['esp_gpio9'] . "',
				esp_gpio9		= '" . $data['esp_gpio9'] . "',
				esp_gpio10		= '" . $data['esp_gpio10'] . "',
				esp_gpio11		= '" . $data['esp_gpio11'] . "',
				esp_gpio12		= '" . $data['esp_gpio12'] . "',
				esp_gpio13		= '" . $data['esp_gpio13'] . "',
				esp_gpio14		= '" . $data['esp_gpio14'] . "',
				esp_gpio15		= '" . $data['esp_gpio15'] . "',
				esp_gpio16		= '" . $data['esp_gpio16'] . "',
				esp_type        = '" . $data['esp_type'] . "',
				esp_rssi	    = '" . $data['esp_rssi'] . "',
				esp_adc_read	= '" . $data['esp_adc_read'] . "',
				esp_adc_trig	= '" . $data['esp_adc_trig'] . "',
				esp_batt        = '" . $data['esp_batt'] . "',
				esp_zone        = '" . $data['esp_zone'] . "',
				esp_location    = '" . $data['esp_location'] . "',
				esp_rx_time     = '" . $data['esp_rx_time'] . "',
				esp_rx_date     = '" . $data['esp_rx_date'] . "',
				esp_actives     = esp_actives + '" . $alarm . "'
			WHERE id            = '" . $data['esp_id'] . "'";

	}
	else
	{
		$sql_array = array(
			'esp_ip'			=> $data['esp_ip'],
			'esp_gpio0'			=> $data['esp_gpio0'],
			'esp_gpio1'			=> $data['esp_gpio1'],
			'esp_gpio2'			=> $data['esp_gpio2'],
			'esp_gpio3'			=> $data['esp_gpio3'],
			'esp_gpio4'			=> $data['esp_gpio4'],
			'esp_gpio5'			=> $data['esp_gpio5'],
			'esp_gpio6'			=> $data['esp_gpio6'],
			'esp_gpio7'			=> $data['esp_gpio7'],
			'esp_gpio8'			=> $data['esp_gpio8'],
			'esp_gpio9'			=> $data['esp_gpio9'],
			'esp_gpio10'		=> $data['esp_gpio10'],
			'esp_gpio11'		=> $data['esp_gpio11'],
			'esp_gpio12'		=> $data['esp_gpio12'],
			'esp_gpio13'		=> $data['esp_gpio13'],
			'esp_gpio14'		=> $data['esp_gpio14'],
			'esp_gpio15'		=> $data['esp_gpio15'],
			'esp_gpio16'		=> $data['esp_gpio16'],
			'esp_rssi'			=> $data['esp_rssi'],
			'esp_adc_read'		=> $data['esp_adc_read'],
			'esp_adc_trig'		=> $data['esp_adc_trig'],
			'esp_type'			=> $data['esp_type'],
			'esp_batt'			=> $data['esp_batt'],
			'esp_zone'			=> $data['esp_zone'],
			'esp_location'		=> $data['esp_location'],
			'esp_rx_time'		=> $data['esp_rx_time'],
			'esp_rx_date'		=> $data['esp_rx_date'],
			'esp_actives'		=> $data['esp_actives'],
			);

		$sql = "INSERT INTO " . devices . $sql_array;

		//var_dump($sql);

	}
	if(!$result = mysqli_query($dbhandle, $sql))
	{
		echo '205/214 INVALID QUERY<br />';
	}
	mysqli_close($dbhandle);
}

function get_last_active_record()
{
	if(!isset($username))
	{
		$username = $_SESSION['user'];
		$password = $_SESSION['pass'];
		$hostname = "localhost";
		$database = "esp-server";
	}

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $database);

	$sql = "SELECT esp_id, esp_ip, esp_timestamp
		FROM devices
		ORDER BY esp_rx_date DESC, esp_rx_time DESC";
	$result = mysqli_query($dbhandle, $sql);
	$row = mysqli_fetch_assoc($result);

	// return id and ip for next process //
	$data['esp_id'] = $row['esp_id'];
	$data['esp_ip'] = $row['esp_ip'];
	mysqli_close($dbhandle);
	return($data);
}


function save_data($data)
{
	global $db;

	if(!isset($username))
	{
		$username = $_SESSION['user'];
		$password = $_SESSION['pass'];
		$hostname = "localhost";
		$database = "esp-server";
	}


	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $database);

	if(!$selected)
	{
		die("275 Could not select devices table");
	}

	$data['esp_rx_date'] = date("Y-m-d");
	$data['esp_rx_time'] = date('H:i:s', time());

	if($data['esp_id'] != 0)
	{
		echo 'UPDATING';

		$sql = "UPDATE devices
			SET
				esp_ip          = '" . $data['ip'] . "',
				esp_gpio0		= '" . $data['gpio0'] . "',
				esp_gpio1		= '" . $data['gpio1'] . "',
				esp_gpio2		= '" . $data['gpio2'] . "',
				esp_gpio3		= '" . $data['gpio3'] . "',
				esp_gpio4		= '" . $data['gpio4'] . "',
				esp_gpio5		= '" . $data['gpio5'] . "',
				esp_gpio9		= '" . $data['gpio9'] . "',
				esp_gpio10		= '" . $data['gpio10'] . "',
				esp_gpio12		= '" . $data['gpio12'] . "',
				esp_gpio13		= '" . $data['gpio13'] . "',
				esp_gpio14		= '" . $data['gpio14'] . "',
				esp_gpio15		= '" . $data['gpio15'] . "',
				esp_gpio16		= '" . $data['gpio16'] . "',
				esp_gpio17		= '" . $data['gpio17'] . "',
				esp_gpio18		= '" . $data['gpio18'] . "',
				esp_gpio19		= '" . $data['gpio19'] . "',

				esp_type        = '" . $data['type'] . "',
				esp_rssi	    = '" . $data['rssi'] . "',
				esp_adc         = '" . $data['adc'] . "',
				esp_adc_reading	= '" . $data['adc_read'] . "',
				esp_adc_trigger	= '" . $data['adc_trig'] . "',
				esp_batt        = '" . $data['batt'] . "',
				esp_zone        = '" . $data['zone'] . "',
				esp_location    = '" . $data['location'] . "',
				esp_rx_time     = '" . $data['rx_time'] . "',
				esp_rx_date     = '" . $data['rx_date'] . "',
				esp_actives     = actives + '" . $alarm . "'
			WHERE id            = '" . $data['id'] . "'";

		if(!$result = mysqli_query($dbhandle, $sql))
		{
			echo 'INVALID QUERY <br />';
		}
		mysqli_close($dbhandle);

	}
	else
	{
		echo 'ADDING';
		$sql_array = array(
			'esp_ip'			=> $data['esp_ip'],
			'esp_gpio0'			=> $data['esp_gpio0'],
			'esp_gpio1'			=> $data['esp_gpio1'],
			'esp_gpio2'			=> $data['esp_gpio2'],
			'esp_gpio3'			=> $data['esp_gpio3'],
			'esp_gpio4'			=> $data['esp_gpio4'],
			'esp_gpio5'			=> $data['esp_gpio5'],
			'esp_gpio6'			=> $data['esp_gpio6'],
			'esp_gpio7'			=> $data['esp_gpio7'],
			'esp_gpio8'			=> $data['esp_gpio8'],
			'esp_gpio9'			=> $data['esp_gpio9'],
			'esp_gpio10'		=> $data['esp_gpio10'],
			'esp_gpio11'		=> $data['esp_gpio11'],
			'esp_gpio12'		=> $data['esp_gpio12'],
			'esp_gpio13'		=> $data['esp_gpio13'],
			'esp_gpio14'		=> $data['esp_gpio14'],
			'esp_gpio15'		=> $data['esp_gpio15'],
			'esp_gpio16'		=> $data['esp_gpio16'],
			'esp_gpio17'		=> $data['esp_gpio17'],
			'esp_gpio18'		=> $data['esp_gpio18'],
			'esp_gpio19'		=> $data['esp_gpio19'],

			'esp_rssi'			=> $data['esp_rssi'],
			'esp_adc_read'		=> $data['esp_adc_read'],
			'esp_adc_trig'		=> $data['esp_adc_trig'],
			'esp_type'			=> $data['esp_type'],
			'esp_batt'			=> $data['esp_batt'],
			'esp_zone'			=> $data['esp_zone'],
			'esp_location'		=> $data['esp_location'],
			'esp_rx_time'		=> $data['esp_rx_time'],
			'esp_rx_date'		=> $data['esp_rx_date'],
			'esp_actives'		=> $data['esp_actives'],
			);
		$sql = "INSERT INTO devices " . $sql_array;
		//$db->sql_query('INSERT INTO devices ' . $db->sql_build_array('INSERT', $sql_array));
		//mysqli_free_result();
		mysqli_close($dbhandle);
	}



}


function get_ips()
{
	if(!isset($username))
	{
		$username = $_SESSION['user'];
		$password = $_SESSION['pass'];
		$hostname = "localhost";
		$database = "esp-server";
	}

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $database);

	if(!$selected)
	{
		die("330 Could not select devices");
	}


	$sql = "SELECT *
		FROM devices
		WHERE esp_is_client = 0
		ORDER BY esp_is_client, esp_location ASC, esp_rx_date DESC, esp_rx_time DESC";
	$result = mysqli_query($dbhandle, $sql);

	while($row = mysqli_fetch_array($result))
	{
		$json_arrays[] = array(
			'id'		=> $row['esp_id'],
			'status'	=> $row['esp_status'],
			'ip'		=> $row['esp_ip'],
			'gpio0'		=> $row['esp_gpio0'],
			'gpio1'		=> $row['esp_gpio1'],
			'gpio2'		=> $row['esp_gpio2'],
			'gpio3'		=> $row['esp_gpio3'],
			'gpio4'		=> $row['esp_gpio4'],
			'gpio5'		=> $row['esp_gpio5'],
			'gpio6'		=> $row['esp_gpio6'],
			'gpio7'		=> $row['esp_gpio7'],
			'gpio8'		=> $row['esp_gpio8'],
			'gpio9'		=> $row['esp_gpio9'],
			'gpio10'	=> $row['esp_gpio10'],
			'gpio11'	=> $row['esp_gpio11'],
			'gpio12'	=> $row['esp_gpio12'],
			'gpio13'	=> $row['esp_gpio13'],
			'gpio14'	=> $row['esp_gpio14'],
			'gpio15'	=> $row['esp_gpio15'],
			'gpio15'	=> $row['esp_gpio16'],
			'type'		=> $row['esp_type'],
			'chan'		=> $row['esp_chan'],
			'zone'		=> $row['esp_zone'],
			'time'		=> $row['esp_rx_time'],
			'date'		=> $row['esp_rx_date'],
			'location'	=> $row['esp_location'],

			'rssi'		=> $row['esp_rssi'],

			'adc_read1'	=> $row['esp_adc_read'],
			'adc_trig1'	=> $row['esp_adc_trig'],

			'batt'		=> $row['esp_batt'],
			'actives'	=> $row['esp_actives'],
			'timenow'	=> date('H:i:s', time()),
		);
	}
	mysqli_close($dbhandle);
	return($json_arrays);
}

/*
function check_login($user, $pass)
{
	global $hostname, $username, $password, $database;
	$esp_login = $database . '.login';

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $database . ".login");

	$sql = "SELECT user, pass, auth
		FROM $esp_login
		WHERE user = '" . $user . "' and pass = '" . $pass . "'";

	$result = mysqli_query($dbhandle, $sql) or die("Error: " . mysqli_error($dbhandle));

	$row = mysqli_fetch_row($result);

	$_SESSION['user'] = $row[0];
	$_SESSION['pass'] = $row[1];
	$_SESSION['auth'] = $row[2];

	mysqli_free_result($result);

	//return;
}
*/
function logout()
{
	if(!isset($username))
	{
		$username = $_SESSION['user'];
		$password = $_SESSION['pass'];
		$hostname = "localhost";
		$database = "esp-server";
	}

	$esp_login = $database . '.login';

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $esp_login);

	$sql = "UPDATE $esp_login
		SET auth = 0
		WHERE user = '" . $_SESSION['user'] . "' and pass = " . $_SESSION['pass'] . "'";

	$result = mysqli_query($dbhandle, $sql) or die("Error: " . mysqli_error($dbhandle));

	$row = mysqli_fetch_row($result);

	$_SESSION['user'] = $row[0];
	$_SESSION['pass'] = $row[1];
	$_SESSION['auth'] = $row[2];

	mysqli_free_result($result);

	return;
}

function fill_array($row)
{
	$json_array = array(
		'id'		=> $row['esp_id'],
		'ip'		=> $row['esp_ip'],
		'gpio0'		=> $row['esp_gpio0'],
		'gpio1'		=> $row['esp_gpio1'],
		'gpio2'		=> $row['esp_gpio2'],
		'gpio3'		=> $row['esp_gpio3'],
		'gpio4'		=> $row['esp_gpio4'],
		'gpio5'		=> $row['esp_gpio5'],
		'gpio6'		=> $row['esp_gpio6'],
		'gpio7'		=> $row['esp_gpio7'],
		'gpio8'		=> $row['esp_gpio8'],
		'gpio9'		=> $row['esp_gpio9'],
		'gpio10'	=> $row['esp_gpio10'],
		'gpio11'	=> $row['esp_gpio11'],
		'gpio12'	=> $row['esp_gpio12'],
		'gpio13'	=> $row['esp_gpio13'],
		'gpio14'	=> $row['esp_gpio14'],
		'gpio15'	=> $row['esp_gpio15'],
		'gpio16'	=> $row['esp_gpio16'],
		'gpio17'	=> $row['esp_gpio17'],
		'gpio18'	=> $row['esp_gpio18'],
		'gpio19'	=> $row['esp_gpio19'],

		'adc10'		=> $row['esp_adc10'],
		'adc13'		=> $row['esp_adc13'],
		'adc14'		=> $row['esp_adc14'],
		'adc15'		=> $row['esp_adc15'],
		'adc16'		=> $row['esp_adc16'],
		'adc17'		=> $row['esp_adc17'],

		'adc20'		=> $row['esp_adc20'],
		'adc21'		=> $row['esp_adc21'],
		'adc22'		=> $row['esp_adc22'],
		'adc23'		=> $row['esp_adc23'],
		'adc24'		=> $row['esp_adc24'],
		'adc25'		=> $row['esp_adc25'],
		'adc26'		=> $row['esp_adc26'],
		'adc27'		=> $row['esp_adc27'],
		'adc28'		=> $row['esp_adc28'],
		'adc29'		=> $row['esp_adc29'],

		'adc_read'	=> $row['esp_adc_read'],
		'adc_trig'	=> $row['esp_adc_trig'],
		'rssi'		=> $row['esp_rssi'],
		'type'		=> $row['esp_type'],
		'chan'		=> $row['esp_chan'],
		'zone'		=> $row['esp_zone'],
		'time'		=> $row['esp_rx_time'],
		'date'		=> $row['esp_rx_date'],
		'location'	=> $row['esp_location'],
		'batt'		=> $row['esp_batt'],
		'actives'	=> $row['esp_actives'],
		'timenow'	=> date('H:i:s', time()),
	);
	return($json_array);
}

function search_records()
{
	echo 'Not Implemented yet!';
}
