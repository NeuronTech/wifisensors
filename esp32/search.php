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

$action = request_var('action', '');

include('partial/header.html');

?>
<script type='text/javascript' src='resources/jquery.js' charset='utf-8'></script>
<script type="text/javascript">

    var ip;
    function getdata()
	{
        ip = document.getElementById('ip').value;
		document.getElementById("ledgend1").innerHTML = 'Data for ' + ip;
		getgpios(ip);
	}

	function getgpios(ip)
	{
		var win = window.open("http://" + ip, 'ESP', 'height=100,width=250').focus();
		setInterval(function() { wait(win); }, 2000);
	}

	function wait(win)
	{
		win.close();
	}
</script>

<?php

include('partial/left_blocks.html');
global $json_array;
include('partial/section_search.html');

?>


<!--
<div class="index_intro">Search for ESP8266 Servers</div>
<div class="divider"></div>
<div class="index_body" style="text-align:center">
If we query an ESP8266 device set up as a Server (using its IP) we can retrieve the current state of the GPIO's and ADC...<br />
We can then save this information to our database for future use...<br /><br />
</div>
-->

<?php
include('partial/footer.html');
