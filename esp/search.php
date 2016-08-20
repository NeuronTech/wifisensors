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

include('header.html');

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


include('left_blocks.html');

$gpio0 = request_var('gpio0', 0);
$gpio1 = request_var('gpio1', 0);
$gpio2 = request_var('gpio2', 0);
$gpio3 = request_var('gpio3', 0);
$gpio4 = request_var('gpio4', 0);
$gpio5 = request_var('gpio5', 0);
$gpio9 = request_var('gpio9', 0);
$gpio10 = request_var('gpio10', 0);
$gpio12 = request_var('gpio12', 0);
$gpio13 = request_var('gpio13', 0);
$gpio14 = request_var('gpio14', 0);
$gpio15 = request_var('gpio15', 0);

?>

<div class="index_intro">Search for ESP8266 Servers</div>
<div class="divider"></div>

<div class="index_body">
If we query an ESP8266 device set up as a Server (using its IP) we can retrieve the current state of the GPIO's and ADC...<br />
We can then save this information to our database for future use...<br /><br />
</div>

<form id="esp_add" name="esp_add" method="post" action="add_device.php?action=submit">
	<div>
		<fieldset>
			<legend id="ledgend1"></legend>

			<dl>
				<dt><label for="ip">IP:</label></dt>
				<dd>
					<input style="border-radius: 5px; width:120px" class="text" type="text" name="ip" id="ip" size="15" maxlength="15" tabindex="1" />
					&nbsp; <a href="#" onclick="getdata()">Process1</a>
				</dd>
			</dl>

			<dl>
				<dt><label for="gpio0">GPIO 0:</label></dt>
				<label><input type="radio" name="gpio0" value="0" onchange="setgpio(0,0)" /> Available</label>
				<label><input type="radio" name="gpio0" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio1">GPIO 1:</label></dt>
				<label><input type="radio" name="gpio1" value="1" onchange="setgpio(0,1)" /> Available</label>
				<label><input type="radio" name="gpio1" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio2">GPIO 2:</label></dt>
				<label><input type="radio" name="gpio2" value="1" onchange="setgpio(0,2)" /> Available</label>
				<label><input type="radio" name="gpio2" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio3">GPIO 3:</label></dt>
				<label><input type="radio" name="gpio3" value="1" onchange="setgpio(0,3)" /> Available</label>
				<label><input type="radio" name="gpio3" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio4">GPIO 4:</label></dt>
				<label><input type="radio" name="gpio4" value="1" onchange="setgpio(0,4)" /> Available</label>
				<label><input type="radio" name="gpio4" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio5">GPIO 5:</label></dt>
				<label><input type="radio" name="gpio5" value="1" onchange="setgpio(0,5)" /> Available</label>
				<label><input type="radio" name="gpio5" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio1">GPIO 9:</label></dt>
				<label><input type="radio" name="gpio9" value="1" onchange="setgpio(0,9)" /> Available</label>
				<label><input type="radio" name="gpio9" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio2">GPIO 10:</label></dt>
				<label><input type="radio" name="gpio10" value="1" onchange="setgpio(0,10)" /> Available</label>
				<label><input type="radio" name="gpio10 value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio3">GPIO 12:</label></dt>
				<label><input type="radio" name="gpio12" value="1" onchange="setgpio(0,12)" /> Available</label>
				<label><input type="radio" name="gpio12" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio4">GPIO 13:</label></dt>
				<label><input type="radio" name="gpio13" value="1" onchange="setgpio(0,13)" /> Available</label>
				<label><input type="radio" name="gpio13" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio5">GPIO 14:</label></dt>
				<label><input type="radio" name="gpio14" value="1" onchange="setgpio(0,14)" /> Available</label>
				<label><input type="radio" name="gpio14" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio4">GPIO 15:</label></dt>
				<label><input type="radio" name="gpio15" value="1" onchange="setgpio(0,15)" /> Available</label>
				<label><input type="radio" name="gpio15" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="gpio5">GPIO 16:</label></dt>
				<label><input type="radio" name="gpio16" value="1" onchange="setgpio(0,16)" /> Available</label>
				<label><input type="radio" name="gpio16" value="0" checked="checked" onchange="setgpio(0,0)" /> Not Available</label>
			</dl>
			<dl>
				<dt><label for="adc">ADC:</label></dt>
				<label><input type="radio" name="adc" value="1" " /> Available</label>
				<label><input type="radio" name="adc" value="0" checked="checked" " /> Not Available</label>
			</dl>
		</fieldset>

		<fieldset class="submit-buttons">
			<input class="button1" type="submit" id="submit" name="submit" value="Submit" />&nbsp;
			<input class="button2" type="reset" id="reset" name="reset" value="Reset" />&nbsp;
		</fieldset>

	</div>
</form>


<?php
include('footer.html');
