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
include($root_path . 'includes/functions.' . $phpEx);


$data = get_last_active();
$json_array = get_data($data['esp_id']);

include('header.html');
include('left_blocks.html');
include('section_monitor.html');
include('footer.html');
