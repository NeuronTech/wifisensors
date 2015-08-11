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

$action = request_var('action', '');

if ($action == 'submit')
{
	$arr = array(
		'esp_id'			=> request_var('esp', 0),
		'esp_chan'			=> request_var('chan', 0),
		'esp_zone'			=> request_var('zone', 0),
		'esp_location'		=> request_var('location', ''),
		'esp_rx_level'		=> request_var('level', 0),
		'esp_batt'			=> request_var('batt', ''),
		'esp_actives'		=> request_var('actives', 0),
		'esp_rx_treshold'	=> request_var('tresh', ''),
	);
	save_data($arr);
	meta_refresh(0, 'index.php?esp_id=' . request_var('esp', 0));
}
else
{
	$id = request_var('esp_id', 0);
	$json_array = get_data($id);
}



include('header.html');
include('left_blocks.html');


?>
<form id="esp" name="esp" method="post" action="index.php?action=submit">
<h3 style="margin: 3px;">Here you can edit the current sensor data...</h3>
	<div>
		<fieldset>
			<legend>Data</legend>
			<dl>
				<dt><label for="esp">ID:</label></dt>
				<dd><input class="post" size="10" maxlength="4" name="esp" value="<?php echo $json_array['esp']; ?>" type="text"></dd>
			</dl>
			<dl>
				<dt><label for="zone">Zone:</label></dt>
				<dd><input class="post" size="10" maxlength="4" name="zone" value="<?php echo $json_array['zone']; ?>" type="text"></dd>
			</dl>
			<dl>
				<dt><label for="chan">Channel:</label></dt>
				<dd><input class="post" size="10" maxlength="4" name="chan" value="<?php echo $json_array['chan']; ?>" type="text"></dd>
			</dl>
			<dl>
				<dt><label for="time">Last activity time:</label></dt>
				<dd><input class="post" size="10" maxlength="4" name="time" value="<?php echo $json_array['time']; ?>" type="text"></dd>
			</dl>
			<dl>
				<dt><label for="date">Last activity date:</label></dt>
				<dd><input class="post" size="10" maxlength="4" name="date" value="<?php echo $json_array['date']; ?>" type="text"></dd>
			</dl>
			<dl>
				<dt><label for="level">Sensor Level:</label></dt>
				<dd><input class="post" size="10" maxlength="4" name="level" value="<?php echo $json_array['level']; ?>" type="text"></dd>
			</dl>
			<dl>
				<dt><label for="tresh">Trigger Level:</label></dt>
				<dd><input class="post" size="10" maxlength="4" name="tresh" value="<?php echo $json_array['tresh']; ?>" type="text"></dd>
			</dl>
			<dl>
				<dt><label for="batt">Battery voltage:</label></dt>
				<dd><input class="post" size="10" maxlength="4" name="batt" value="<?php echo $json_array['batt']; ?>" type="text"></dd>
			</dl>
			<dl>
				<dt><label for="actives">Total activations:</label></dt>
				<dd><input class="post" size="10" maxlength="4" name="actives" value="<?php echo $json_array['actives']; ?>" type="text"></dd>
			</dl>
			<dl>
				<dt><label for="location">Location:</label></dt>
				<dd><input class="post" size="24" maxlength="100" name="location" value="<?php echo $json_array['location']; ?>" type="text"></dd>
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
