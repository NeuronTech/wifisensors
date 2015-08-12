<script type='text/javascript' src='info/jquery.js' charset='utf-8'></script>
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
			switch(key)
			{
				case "esp":
				 document.getElementById("esp").innerHTML = val;
				break;
				case "chan":
				 document.getElementById("chan").innerHTML = val;
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
				case "level":
				 document.getElementById("level").innerHTML = val;
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


$msg = ">";
$data = start();

if (!$data)
{
	$data .= " Copyright Mike O'Toole 13062015 ";
}

include_once('includes/functions.php');

$data = get_last_active();

$json_array = get_data($data['esp_id']);

include('header.html');
include('left_blocks.html');

?>

<h4 style="margin: 3px; margin-bottom:10px;">Latest activity:  <?php echo $json_array['time']; ?> (<?php echo $json_array['date']; ?>) </h4>
	<div class="box" style="margin:0; margin-bottom: 20px; ">

		<ul>
			<li>ESP: <span class="ajax" id="esp" style="font-size:15px">
			<?php echo $json_array['esp']; ?>
			</span></li>
			<li>Zone: <span class="ajax" id="zone" style="font-size:15px">
			<?php echo $json_array['zone']; ?>
			</span></li>
			<li>Channel: <span class="ajax" id="chan" style="font-size:15px">
			<?php echo $json_array['chan']; ?>
			</span></li>
			<li>Location: <span class="ajax" id="location" style="font-size:15px">
			<?php echo $json_array['location']; ?>
			</span></li>
			<li>Time: <span class="ajax" id="time" style="font-size:15px">
			<?php echo $json_array['time']; ?>
			</span> (UCT)</li>
			<li>Date: <span class="ajax" id="date" style="font-size:15px">
			<?php echo $json_array['date']; ?>
			</span></li>
			<li>Sensor: <span class="ajax" id="level" style="font-size:15px">
			<?php echo $json_array['level']; ?>
			</span></li>
			<li>Battery: <span class="ajax" id="batt" style="font-size:15px;">
			<?php echo $json_array['batt']; ?>
			</span> Volts</li>
			<li>Actives: <span class="ajax" id="actives" style="font-size:15px;">
			<?php echo $json_array['actives']; ?>
			</span></li>
		</ul>
	</div>
<?php

include('footer.html');
