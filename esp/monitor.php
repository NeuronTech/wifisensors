<script type='text/javascript' src='resources/jquery.js' charset='utf-8'></script>
<script type="text/javascript">
function displayLiveData()
{
	// Request the data in JSON format from the server
	var currentTime = new Date();

	$.getJSON('includes/getjsondata.php?datatype=full&' + currentTime.getTime(), function(data)
	{
		var items = [];
		$.each(data, function(key, val)
		{
			//alert(document.getElementById("id").innerHTML = val);

			switch(key)
			{
				case "id":
				 document.getElementById("id").innerHTML = val;
				break;
				case "gpio0":
				 document.getElementById("gpio0").innerHTML = val;
				break;
				case "gpio1":
				 document.getElementById("gpio1").innerHTML = val;
				break;
				case "gpio2":
				 document.getElementById("gpio2").innerHTML = val;
				break;
				case "gpio3":
				 document.getElementById("gpio3").innerHTML = val;
				break;
				case "gpio4":
				 document.getElementById("gpio4").innerHTML = val;
				break;
				case "gpio":
				 document.getElementById("gpio5").innerHTML = val;
				break;
				case "gpio9*":
				 document.getElementById("gpio9").innerHTML = val;
				break;
				case "gpio10":
				 document.getElementById("gpio10").innerHTML = val;
				break;
				case "gpio12":
				 document.getElementById("gpio12").innerHTML = val;
				break;
				case "gpio13":
				 document.getElementById("gpio13").innerHTML = val;
				break;
				case "gpio14":
				 document.getElementById("gpio14").innerHTML = val;
				break;
				case "gpio15":
				 document.getElementById("gpio15").innerHTML = val;
				break;
				case "gpio16":
				 document.getElementById("gpio16").innerHTML = val;
				break;
				case "zone":
				 document.getElementById("zone").innerHTML = val;
				break;
				case "time":
				 document.getElementById("time").innerHTML = val;
				break;
				case "date":
				 document.getElementById("date").innerHTML = val;
				break;
				case "rssi":
				 document.getElementById("rssi").innerHTML = val;
				break;
				case "adc":
				 document.getElementById("adc").innerHTML = val;
				break;
				case "adc_reading":
				 document.getElementById("adc_reading").innerHTML = val;
				break;
				case "adc_trigger":
				 document.getElementById("adc_trigger").innerHTML = val;
				break;
				case "batt":
				 document.getElementById("batt").innerHTML = val;
				break;
				case "actives":
				 document.getElementById("actives").innerHTML = val;
				break;
				case "location":
				 document.getElementById("location").innerHTML = val;
				break;
				case "timenow":
				 document.getElementById("timenow").innerHTML = 'Time: ' + val;
				break;
			}
		});
	});
}
onload = function ()
{
  t = window.setInterval("displayLiveData()", 2000);
};
</script>

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

if (!$auth)
{
	header('Location: login.php');
	exit;
}


$data = get_last_active();
$json_array = get_data($data['id']);

include('header.html');
include('left_blocks.html');
include('section_monitor.html');
include('footer.html');
