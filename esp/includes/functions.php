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

function get_data($id, $all = false)
{
	//include('database.php');
	global $hostname, $username, $password, $database;

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $database);

	if(!$selected)
	{
		die("12 Could not select devices");
	}

	if ($all)
	{
		$sql = "SELECT *
			FROM devices
			ORDER BY esp_is_client, esp_location ASC, esp_rx_date DESC, esp_rx_time DESC";

		$result = mysqli_query($dbhandle, $sql);

		while($row = mysqli_fetch_array($result))
		{
			$json_arrays[] = array(
				'id'		=> $row['id'],
				'ip'		=> $row['esp_ip'],
				'status'	=> $row['esp_status'],
				'gpio0'		=> $row['esp_gpio0'],
				'gpio1'		=> $row['esp_gpio1'],
				'gpio2'		=> $row['esp_gpio2'],
				'gpio3'		=> $row['esp_gpio3'],
				'gpio4'		=> $row['esp_gpio4'],
				'gpio5'		=> $row['esp_gpio5'],
				'gpio9'		=> $row['esp_gpio9'],
				'gpio10'	=> $row['esp_gpio10'],
				'gpio12'	=> $row['esp_gpio12'],
				'gpio13'	=> $row['esp_gpio13'],
				'gpio14'	=> $row['esp_gpio14'],
				'gpio15'	=> $row['esp_gpio15'],
				'gpio16'	=> $row['esp_gpio16'],

				'rssi'		=> $row['esp_rssi'],
				'adc'		=> $row['esp_adc'],
				'adc_reading'	=> $row['esp_adc_reading'],
				'adc_trigger'	=> $row['esp_adc_trigger'],

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
		}

		mysqli_close($dbhandle);
		return($json_arrays);
	}
	else if ($id)
	{
		$sql = "SELECT *
			FROM devices
			WHERE id = " . $id . "
			ORDER BY esp_is_client, esp_type, esp_rx_date DESC, esp_rx_time DESC";

		$result = mysqli_query($dbhandle, $sql);
		$row = mysqli_fetch_assoc($result);

		$json_array = array(
			'id'		=> $row['id'],
			'ip'		=> $row['esp_ip'],
			'gpio0'		=> $row['esp_gpio0'],
			'gpio1'		=> $row['esp_gpio1'],
			'gpio2'		=> $row['esp_gpio2'],
			'gpio3'		=> $row['esp_gpio3'],
			'gpio4'		=> $row['esp_gpio4'],
			'gpio5'		=> $row['esp_gpio5'],
			'gpio9'		=> $row['esp_gpio9'],
			'gpio10'	=> $row['esp_gpio10'],
			'gpio12'	=> $row['esp_gpio12'],
			'gpio13'	=> $row['esp_gpio13'],
			'gpio14'	=> $row['esp_gpio14'],
			'gpio15'	=> $row['esp_gpio15'],
			'gpio16'	=> $row['esp_gpio16'],

			'rssi'		=> $row['esp_rssi'],
			'adc'		=> $row['esp_adc'],
			'adc_reading'	=> $row['esp_adc_reading'],
			'adc_trigger'	=> $row['esp_adc_trigger'],

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
	}
	else if ($id == 0)
	{
		$sql = "SELECT *
			FROM devices
			ORDER BY esp_rx_date DESC, esp_rx_time DESC";
		$result = mysqli_query($dbhandle, $sql);

		$row = mysqli_fetch_assoc($result);

		$json_array = array(
			'id'		=> $row['id'],
			'ip'		=> $row['esp_ip'],
			'gpio0'		=> $row['esp_gpio0'],
			'gpio1'		=> $row['esp_gpio1'],
			'gpio2'		=> $row['esp_gpio2'],
			'gpio3'		=> $row['esp_gpio3'],
			'gpio4'		=> $row['esp_gpio4'],
			'gpio5'		=> $row['esp_gpio5'],
			'gpio9'		=> $row['esp_gpio9'],
			'gpio10'	=> $row['esp_gpio10'],
			'gpio12'	=> $row['esp_gpio12'],
			'gpio13'	=> $row['esp_gpio13'],
			'gpio14'	=> $row['esp_gpio14'],
			'gpio15'	=> $row['esp_gpio15'],
			'gpio16'	=> $row['esp_gpio16'],

			'rssi'		=> $row['esp_rssi'],
			'adc'		=> $row['esp_adc'],
			'adc_reading'	=> $row['esp_adc_reading'],
			'adc_trigger'	=> $row['esp_adc_trigger'],

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
	}

	mysqli_close($dbhandle);
	return($json_array);
}


function put_data($data)
{
	$new = false;

	//include('database.php');
	global $hostname, $username, $password, $database;

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $database);

	if(!$selected)
	{
		die("155 Could not select devices table");
	}
	$id = $data['id'];

	$data['esp_rx_date'] = date("Y-m-d");
	$data['esp_rx_time'] = date('H:i:s', time());
	$alarm = ($data['esp_rssi'] >= $data['esp_rssi']) ? 1 : 0;

	if (!$new)
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
				esp_gpio9		= '" . $data['esp_gpio9'] . "',
				esp_gpio10		= '" . $data['esp_gpio10'] . "',
				esp_gpio12		= '" . $data['esp_gpio12'] . "',
				esp_gpio13		= '" . $data['esp_gpio13'] . "',
				esp_gpio14		= '" . $data['esp_gpio14'] . "',
				esp_gpio15		= '" . $data['esp_gpio15'] . "',
				esp_gpio16		= '" . $data['esp_gpio16'] . "',
				esp_type        = '" . $data['esp_type'] . "',

				esp_rssi	    = '" . $data['esp_rssi'] . "',
				esp_adc         = '" . $data['esp_adc'] . "',
				esp_adc_reading	= '" . $data['esp_adc_reading'] . "',
				esp_adc_trigger	= '" . $data['esp_adc_trigger'] . "',

				esp_batt        = '" . $data['esp_batt'] . "',
				esp_zone        = '" . $data['esp_zone'] . "',
				esp_location    = '" . $data['esp_location'] . "',
				esp_rx_time     = '" . $data['esp_rx_time'] . "',
				esp_rx_date     = '" . $data['esp_rx_date'] . "',
				esp_actives     = esp_actives + '" . $alarm . "'
			WHERE id            = '" . $data['id'] . "'";

	}
	else if($new)
	{
		$sql_array = array(
			'esp_ip'			=> $data['esp_ip'],
			'esp_gpio0'			=> $data['esp_gpio0'],
			'esp_gpio1'			=> $data['esp_gpio1'],
			'esp_gpio2'			=> $data['esp_gpio2'],
			'esp_gpio3'			=> $data['esp_gpio3'],
			'esp_gpio4'			=> $data['esp_gpio4'],
			'esp_gpio5'			=> $data['esp_gpio5'],
			'esp_gpio9'			=> $data['esp_gpio9'],
			'esp_gpio10'		=> $data['esp_gpio10'],
			'esp_gpio12'		=> $data['esp_gpio12'],
			'esp_gpio13'		=> $data['esp_gpio13'],
			'esp_gpio14'		=> $data['esp_gpio14'],
			'esp_gpio15'		=> $data['esp_gpio15'],
			'esp_gpio16'		=> $data['esp_gpio16'],

			'esp_rssi'			=> $data['esp_rssi'],
			'esp_adc'			=> $data['esp_adc'],
			'esp_adc_reading'	=> $data['esp_adc_reading'],
			'esp_adc_trigger'	=> $data['esp_adc_trigger'],

			'esp_type'			=> $data['esp_type'],
			'esp_batt'			=> $data['esp_batt'],
			'esp_zone'			=> $data['esp_zone'],
			'esp_location'		=> $data['esp_location'],
			'esp_rx_time'		=> $data['esp_rx_time'],
			'esp_rx_date'		=> $data['esp_rx_date'],
			'esp_actives'		=> $data['esp_actives'],
			);

		$sql = "INSERT INTO " . devices . $sql_array;

		var_dump($sql);

	}
	if(!$result = mysqli_query($dbhandle, $sql))
	{
		echo '205/214 INVALID QUERY<br />';
	}
	mysqli_close($dbhandle);
}

function get_last_active()
{
	//include('database.php');
	global $hostname, $username, $password, $database;

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $database);

	$sql = "SELECT id, esp_timestamp
		FROM devices
		ORDER BY esp_rx_date DESC, esp_rx_time DESC";
	$result = mysqli_query($dbhandle, $sql);

	$row = mysqli_fetch_assoc($result);
	//$data['esp_rssi'] = $row['esp_rssi'];
	$data['id'] = $row['id'];
	mysqli_close($dbhandle);
	return($data);
}


function save_data($data)
{
	//include('database.php');
	global $hostname, $username, $password, $database;

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, $database);

	$id = $data['id'];

	if (!$id)
	{
		die("function.php 272 No ID Passed");
	}

	if(!$selected)
	{
		die("275 Could not select devices table");
	}

	$data['esp_rx_date'] = date("Y-m-d");
	$data['esp_rx_time'] = date('H:i:s', time());


	$sql = "UPDATE devices
		SET
			esp_ip          = '" . $data['esp_ip'] . "',
			esp_gpio0		= '" . $data['esp_gpio0'] . "',
			esp_gpio1		= '" . $data['esp_gpio1'] . "',
			esp_gpio2		= '" . $data['esp_gpio2'] . "',
			esp_gpio3		= '" . $data['esp_gpio3'] . "',
			esp_gpio4		= '" . $data['esp_gpio4'] . "',
			esp_gpio5		= '" . $data['esp_gpio5'] . "',
			esp_gpio9		= '" . $data['esp_gpio9'] . "',
			esp_gpio10		= '" . $data['esp_gpio10'] . "',
			esp_gpio12		= '" . $data['esp_gpio12'] . "',
			esp_gpio13		= '" . $data['esp_gpio13'] . "',
			esp_gpio14		= '" . $data['esp_gpio14'] . "',
			esp_gpio15		= '" . $data['esp_gpio15'] . "',
			esp_gpio16		= '" . $data['esp_gpio16'] . "',

			esp_rssi		= '" . $data['esp_rssi'] . "',
			esp_adc         = '" . $data['esp_adc'] . "',
			esp_adc_reading	= '" . $data['esp_adc_reading'] . "',
			esp_adc_trigger	= '" . $data['esp_adc_trigger'] . "',

			esp_type        = '" . $data['esp_type'] . "',
			esp_batt        = '" . $data['esp_batt'] . "',
			esp_zone        = '" . $data['esp_zone'] . "',
			esp_location    = '" . $data['esp_location'] . "',
			esp_rx_time     = '" . $data['esp_rx_time'] . "',
			esp_rx_date     = '" . $data['esp_rx_date'] . "',
			esp_actives     = '" . $data['esp_actives'] . "'
		WHERE id            = '" . $data['id'] . "'";

	if (DEBUG)
	{
		var_dump($sql);
	}

	if(!$result = mysqli_query($dbhandle, $sql))
	{
		echo 'INVALID QUERY<br />';
		echo $sql;
	}
	mysqli_close($dbhandle);
}


function get_ips()
{
	//include('database.php');
	global $hostname, $username, $password, $database;

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
			'id'		=> $row['id'],
			'status'	=> $row['esp_status'],
			'ip'		=> $row['esp_ip'],
			'gpio0'		=> $row['esp_gpio0'],
			'gpio1'		=> $row['esp_gpio1'],
			'gpio2'		=> $row['esp_gpio2'],
			'gpio3'		=> $row['esp_gpio3'],
			'gpio4'		=> $row['esp_gpio4'],
			'gpio5'		=> $row['esp_gpio5'],
			'gpio9'		=> $row['esp_gpio9'],
			'gpio10'	=> $row['esp_gpio10'],
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
			'adc'		=> $row['esp_adc'],
			'adc_reading'	=> $row['esp_adc_reading'],
			'adc_trigger'	=> $row['esp_adc_trigger'],

			'batt'		=> $row['esp_batt'],
			'actives'	=> $row['esp_actives'],
			'timenow'	=> date('H:i:s', time()),
		);
	}
	mysqli_close($dbhandle);
	return($json_arrays);
}

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
function logout()
{
	//include('database.php');
	global $hostname, $username, $password, $database;
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

?>