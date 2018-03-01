<?php

function get_data($id, $all = false)
{
	include('database.php');

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, "esp");

	if(!$selected)
	{
		die("12 Could not select devices");
	}

	if ($all)
	{

		$sql = "SELECT *
			FROM devices
			ORDER BY esp_location ASC, esp_rx_date DESC, esp_rx_time DESC";
		$result = mysqli_query($dbhandle, $sql);

		while($row = mysqli_fetch_array($result))
		{
			$json_arrays[] = array(
				'status'	=> $row['esp_status'],
				'esp'		=> $row['esp_id'],
				'ip'		=> $row['esp_ip'],
				'chan'		=> $row['esp_chan'],
				'zone'		=> $row['esp_zone'],
				'time'		=> $row['esp_rx_time'],
				'date'		=> $row['esp_rx_date'],
				'location'	=> $row['esp_location'],
				'level'		=> $row['esp_rx_level'],
				'tresh'		=> $row['esp_rx_tresh'],
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
			WHERE esp_id = " . $id . "
			ORDER BY esp_rx_date DESC, esp_rx_time DESC";
		$result = mysqli_query($dbhandle, $sql);

		$row = mysqli_fetch_assoc($result);

		$json_array = array(
			'esp'		=> $row['esp_id'],
			'ip'		=> $row['esp_ip'],
			'chan'		=> $row['esp_chan'],
			'zone'		=> $row['esp_zone'],
			'time'		=> $row['esp_rx_time'],
			'date'		=> $row['esp_rx_date'],
			'location'	=> $row['esp_location'],
			'level'		=> $row['esp_rx_level'],
			'tresh'		=> $row['esp_rx_tresh'],
			'batt'		=> $row['esp_batt'],
			'actives'	=> $row['esp_actives'],
			'timenow'	=> date('H:i:s', time()),
		);
	}
	else if ($id == 0)
	{
		// grab the last active sensor data //
		$sql = "SELECT *
			FROM devices
			ORDER BY esp_rx_date DESC, esp_rx_time DESC";
		$result = mysqli_query($dbhandle, $sql);

		$row = mysqli_fetch_assoc($result);

		$json_array = array(
			'esp'		=> $row['esp_id'],
			'ip'		=> $row['esp_ip'],
			'chan'		=> $row['esp_chan'],
			'zone'		=> $row['esp_zone'],
			'time'		=> $row['esp_rx_time'],
			'date'		=> $row['esp_rx_date'],
			'location'	=> $row['esp_location'],
			'level'		=> $row['esp_rx_level'],
			'tresh'		=> $row['esp_rx_tresh'],
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
	include('database.php');

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, "esp");

	if(!$selected)
	{
		die("62 Could not select devices table");
	}

	if (!isset($data))
	{
		$data = get_last_active();
	}

	//
	$data['esp_rx_date'] = date("Y-m-d");
	$data['esp_rx_time'] = date('H:i:s', time());

	$alarm = ($data['esp_rx_level'] >= $data['esp_rx_tresh']) ? 1 : 0;

	if($data['esp_actives'] == 999)
	{
		$sql = "UPDATE devices
			SET
				esp_rx_level    = '" . $data['esp_rx_level'] . "',
				esp_rx_tresh	= '" . $data['esp_rx_tresh'] . "',
				esp_batt        = '" . $data['esp_batt'] . "',
				esp_zone        = '" . $data['esp_zone'] . "',
				esp_location    = '" . $data['esp_location'] . "',
				esp_rx_time     = '" . $data['esp_rx_time'] . "',
				esp_rx_date     = '" . $data['esp_rx_date'] . "',
				esp_actives     = '" . '0' . "'
			WHERE esp_id        = '" . $data['esp_id'] . "'";
	}
	else
	{
		$sql = "UPDATE devices
			SET
				esp_rx_level    = '" . $data['esp_rx_level'] . "',
				esp_rx_tresh	= '" . $data['esp_rx_tresh'] . "',
				esp_batt        = '" . $data['esp_batt'] . "',
				esp_zone        = '" . $data['esp_zone'] . "',
				esp_location    = '" . $data['esp_location'] . "',
				esp_rx_time     = '" . $data['esp_rx_time'] . "',
				esp_rx_date     = '" . $data['esp_rx_date'] . "',
				esp_actives     = esp_actives + '" . $alarm . "'
			WHERE esp_id        = '" . $data['esp_id'] . "'";
	}

	echo $sql;


	if(!$result = mysqli_query($dbhandle, $sql))
	{
		echo 'INVALID QUERY<br />';
		echo $sql;
	}
	mysqli_close($dbhandle);
}

function get_last_active()
{
	include('database.php');

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, "esp");

	// get last updated entry //
	$sql = "SELECT esp_id, esp_rx_tresh, esp_timestamp
		FROM devices
		ORDER BY esp_timestamp DESC";
	$result = mysqli_query($dbhandle, $sql);
	$row = mysqli_fetch_assoc($result);
	$data['esp_rx_tresh'] = $row['esp_rx_tresh'];
	$data['esp_id'] = $row['esp_id'];
	mysqli_close($dbhandle);

	return($data);
}


function save_data($data)
{
	include('database.php');

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, "esp");

	if(!$selected)
	{
		die("193 Could not select devices table");
	}

	$data['esp_rx_date'] = date("Y-m-d");
	$data['esp_rx_time'] = date('H:i:s', time());

	if($data['esp_id'] == 0 && $data['esp_ip'])
	{
		$sql = "INSERT INTO devices . $db->sql_build_array('INSERT', array(
				esp_ip			=> $data['esp_ip'],
				esp_type		=> $data['esp_type'],
				esp_location    => $data['esp_location'],
				esp_zone        => $data['esp_zone'],
				esp_batt		=> $data['esp_batt'],
				esp_actives     => $data['esp_actives'];
				esp_gpio0		=> $data['esp_gpio0'],
				esp_gpio1		=> $data['esp_gpio1'],
				esp_gpio2		=> $data['esp_gpio2'],
				esp_gpio3		=> $data['esp_gpio3'],
				esp_gpio4		=> $data['esp_gpio4'],
				esp_gpio6		=> $data['esp_gpio5'],
				esp_gpio7		=> $data['esp_gpio6'],
				esp_gpio8		=> $data['esp_gpio7'],
				esp_gpio9		=> $data['esp_gpio8'],
				esp_gpio9		=> $data['esp_gpio9'],
				esp_gpio10		=> $data['esp_gpio10'],
				esp_gpio11		=> $data['esp_gpio11'],
				esp_gpio12		=> $data['esp_gpio12'],
				esp_gpio13		=> $data['esp_gpio13'],
				esp_gpio14		=> $data['esp_gpio14'],
				esp_gpio15		=> $data['esp_gpio15'],
				esp_gpio16		=> $data['esp_gpio16'],
				esp_rssi		=> $data['esp_rssi'],
				esp_adc			=> $data['esp_adc'],
				esp_adc_read	=> $data['esp_adc_read'],
				esp_adc_trig	=> $data['esp_adc_trig'],
				esp_rx_tresh	=> $data['esp_rx_tresh'],
				esp_batt        => $data['esp_batt']',
				esp_rx_time     => $data['esp_rx_time'],
				esp_rx_date     => $data['esp_rx_date']
		$db->sql_query($sql);
	}
	else
	{
		$sql = "UPDATE devices
			SET
				esp_rx_level    = '" . $data['esp_rx_level'] . "',
				esp_rx_tresh	= '" . $data['esp_rx_tresh'] . "',
				esp_batt        = '" . $data['esp_batt'] . "',
				esp_zone        = '" . $data['esp_zone'] . "',
				esp_location    = '" . $data['esp_location'] . "',
				esp_rx_time     = '" . $data['esp_rx_time'] . "',
				esp_rx_date     = '" . $data['esp_rx_date'] . "',
				esp_actives     = '" . $data['esp_actives'] . "'
			WHERE esp_id        = '" . $data['esp_id'] . "'";
	}

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