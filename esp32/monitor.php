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
?>

<script type="text/javascript">
function displayLiveData()
{
	var currentTime = new Date();

	$.getJSON('includes/getjsondata.php', function(data)
	{
		var items = [];
		$.each(data, function(key, val)
		{
			switch(key)
			{
				case "id":
				 document.getElementById("id").innerHTML = val;
				break;
				case "ip":
				 document.getElementById("ip").innerHTML = val;
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
				case "gpio5":
				 document.getElementById("gpio5").innerHTML = val;
				break;
				case "gpio6":
				 document.getElementById("gpio6").innerHTML = val;
				break;
				case "gpio7":
				 document.getElementById("gpio7").innerHTML = val;
				break;
				case "gpio8":
				 document.getElementById("gpio8").innerHTML = val;
				break;
				case "gpio9":
				 document.getElementById("gpio9").innerHTML = val;
				break;
				case "gpio10":
				 document.getElementById("gpio10").innerHTML = val;
				break;
				case "gpio11":
				 document.getElementById("gpio11").innerHTML = val;
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
				case "gpio17":
				 document.getElementById("gpio17").innerHTML = val;
				break;
				case "gpio18":
				 document.getElementById("gpio18").innerHTML = val;
				break;
				case "gpio19":
				 document.getElementById("gpio19").innerHTML = val;
				break;
				case "adc10":
				 document.getElementById("adc10").innerHTML = val;
				break;
				case "adc13":
				 document.getElementById("adc13").innerHTML = val;
				break;
				case "adc14":
				 document.getElementById("adc14").innerHTML = val;
				break;
				case "adc15":
				 document.getElementById("adc15").innerHTML = val;
				break;
				case "adc16":
				 document.getElementById("adc16").innerHTML = val;
				break;
				case "adc17":
				 document.getElementById("adc17").innerHTML = val;
				break;
				case "adc20":
				 document.getElementById("adc20").innerHTML = val;
				break;
				case "adc21":
				 document.getElementById("adc21").innerHTML = val;
				break;
				case "adc23":
				 document.getElementById("adc23").innerHTML = val;
				break;
				case "adc24":
				 document.getElementById("adc24").innerHTML = val;
				break;
				case "adc25":
				 document.getElementById("adc25").innerHTML = val;
				break;
				case "adc26":
				 document.getElementById("adc26").innerHTML = val;
				break;
				case "adc27":
				 document.getElementById("adc27").innerHTML = val;
				break;
				case "adc28":
				 document.getElementById("adc28").innerHTML = val;
				break;
				case "adc29":
				 document.getElementById("adc29").innerHTML = val;
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
				case "adc_read":
				 document.getElementById("adc_read").innerHTML = val;
				break;
				case "adc_trig":
				 document.getElementById("adc_trig").innerHTML = val;
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
	setInterval(function() { displayLiveData(); }, 8000);
};
</script>

<?php

/*
	get last active record in database...
	get_record can return a record using the id, ip, all records or last active...
*/

$json_array = get_record(0, 0);

include('partial/header.html');
include('partial/left_blocks.html');
include('partial/section_monitor.html');
include('partial/footer.html');
