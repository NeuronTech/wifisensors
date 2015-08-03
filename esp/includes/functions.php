<?php

function get_data()
{
	include('database.php');

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, "esp");

	if(!$selected)
	{
		die("75 Could not select devices");
	}

	$sql = "SELECT *
		FROM devices
		WHERE esp_status = 1
		ORDER BY esp_rx_date DESC, esp_rx_time DESC";

	$result = mysqli_query($dbhandle, $sql);
	$row = mysqli_fetch_assoc($result);

//  $row = mysqli_fetch_array($result);
//	while($row = mysqli_fetch_array($result))
//	{
		//$d = explode (' ', $row['esp_rx_time']);

		$json_array = array(
			'esp'		=> $row['esp_id'],
			'chan'		=> $row['esp_chan'],
			'zone'		=> $row['esp_zone'],
			'time'		=> $row['esp_rx_time'],
			'date'		=> $row['esp_rx_date'],
			'location'	=> $row['esp_location'],
			'level'		=> $row['esp_rx_level'],
			'batt'		=> $row['esp_batt'],
			'actives'	=> $row['esp_actives'],
			'timenow'	=> date('H:i:s', time()),
		);

//	}

	mysqli_close($dbhandle);
	return($json_array);
}


function put_data($data)
{
	include('database.php');

	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "esp";

	$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
	$selected = mysqli_select_db($dbhandle, "esp");

	if(!$selected)
	{
		die("62 Could not select devices table");
	}

	//
	$data['esp_rx_date'] = date("Y-m-d");
	$data['esp_rx_time'] = date("H:i:s");

	//var_dump($data['esp_rx_time']);

	if($data['esp_actives'] == 999)
	{
		$sql = "UPDATE devices
			SET
				esp_rx_level = '" . $data['esp_rx_level'] . "',
				esp_batt     = '" . $data['esp_batt'] . "',
				esp_zone     = '" . $data['esp_zone'] . "',
				esp_location = '" . $data['esp_location'] . "',
				esp_rx_time  = '" . $data['esp_rx_time'] . "',
				esp_rx_date  = '" . $data['esp_rx_date'] . "',
				esp_actives  = '" . '1' . "'
			WHERE esp_id     = '" . $data['esp_id'] . "'";
	}
	else
	{
		$sql = "UPDATE devices
			SET
				esp_rx_level = '" . $data['esp_rx_level'] . "',
				esp_batt     = '" . $data['esp_batt'] . "',
				esp_zone     = '" . $data['esp_zone'] . "',
				esp_location = '" . $data['esp_location'] . "',
				esp_rx_time  = '" . $data['esp_rx_time'] . "',
				esp_rx_date  = '" . $data['esp_rx_date'] . "',
				esp_actives  = esp_actives + '" . '0' . "'
			WHERE esp_id     = '" . $data['esp_id'] . "'";
	}

	echo $sql;


	if(!$result = mysqli_query($dbhandle, $sql))
	{
		echo 'INVALID QUERY<br />';
		echo $sql;
	}
	mysqli_close($dbhandle);
}
