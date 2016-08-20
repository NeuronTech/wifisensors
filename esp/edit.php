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

include('header.html');


$id = request_var('id', 0);
$action = request_var('action', '');
$mode = request_var('mode', '');

if ($action = 'submit' && $mode == 'save')
{
	$arr = array(
		'id'				=> $id,
		'esp_ip'			=> request_var('ip', ''),

		'esp_gpio0'			=> request_var('gpio0', 0),
		'esp_gpio1'			=> request_var('gpio1', 0),
		'esp_gpio2'			=> request_var('gpio2', 0),
		'esp_gpio3'			=> request_var('gpio3', 0),
		'esp_gpio4'			=> request_var('gpio4', 0),
		'esp_gpio5'			=> request_var('gpio5', 0),
		'esp_gpio9'			=> request_var('gpio9', 0),
		'esp_gpio10'		=> request_var('gpio10', 0),
		'esp_gpio12'		=> request_var('gpio12', 0),
		'esp_gpio13'		=> request_var('gpio13', 0),
		'esp_gpio14'		=> request_var('gpio14', 0),
		'esp_gpio15'		=> request_var('gpio15', 0),
		'esp_gpio16'		=> request_var('gpio16', 0),

		'esp_type'			=> request_var('type', ''),
		'esp_chan'			=> request_var('chan', 0),
		'esp_zone'			=> request_var('zone', 0),
		'esp_location'		=> request_var('location', ''),
		'esp_batt'			=> request_var('batt', ''),
		'esp_actives'		=> request_var('actives', 0),

		'esp_rssi'			=> request_var('rssi', 0),
		'esp_adc'			=> request_var('adc', 0),
		'esp_adc_reading'		=> request_var('adc_reading', 0),
		'esp_adc_trigger'		=> request_var('adc_trigger', 0),
	);

	save_data($arr);
	get_data($id);
	$mode = 'lookup';
	$action = 'refresh';
	meta_refresh(0, 'edit.php?id=' . $id);
}
else
{
	$json_array = get_data($id);
}

include('left_blocks.html');
?>


<div class="formbox">
<form class="formdata" id="esp_edit" name="esp_edit" method="post" action="edit.php?action=submit">
	<ul>
		<li>
			<div class="col4">
				<label for="id">ID:</label>
				<input hidden id="id" name="id" class="input" value="<?php echo $json_array['id']; ?>" />
				<?php echo $json_array['id']; ?>
			</div>
			<div class="col4">&nbsp;
			</div>
			<div class="col4">&nbsp;
			</div>
			<div class="col4">
				<label for="ip">IP:</label>
				<input type="text" id="ip" name="ip" class="input" value="<?php echo $json_array['ip']; ?>" />
			</div>
		</li>
		<hr class="fade" />
		<li>
			<div class="col2">
				<label for="location">Location:</label>
				<input type="text" id="location" name="location" class="input" value="<?php echo $json_array['location']; ?>" />
			</div>
			<div class="col2">
				<label for="type">Type:</label>
				<input type="text" id="type" name="type" class="input" value="<?php echo $json_array['type']; ?>" />
			</div>
		</li>
		<li>
			<div class="col4">
				<label for="time">Time:</label>
				<input type="text" id="time" name="time" class="input" value="<?php echo $json_array['time']; ?>" />
			</div>
			<div class="col4">
				<label for="date">Date:</label>
				<input type="text" id="date" name="date" class="input" value="<?php echo $json_array['date']; ?>" />
			</div>
			<div class="col4">
				<label for="barr">Battery:</label>
				<input type="text" id="batt" name="batt" class="input" value="<?php echo $json_array['batt']; ?>" />
			</div>
			<div class="col4 omega">
				<label for="rssi">RX Signal Level:</label>
				<input type="text" id="rssi" name="rssi" class="input" value="<?php echo $json_array['rssi']; ?>" />
			</div>
		</li>
		<li>
			<div class="col4">
				<label for="adc_reading">ADC Reading:</label>
				<input type="text" id="adc_reading" name="adc_reading" class="input" value="<?php echo $json_array['adc_reading']; ?>" />
			</div>
			<div class="col4">
				<label for="adc_trigger">ADC Trigger Level:</label>
				<input type="text" id="adc_trigger" name="adc_trigger" class="input" value="<?php echo $json_array['adc_trigger']; ?>" />
			</div>
			<div class="col4">
				<label for="actives">Total activations:</label>
				<input type="text" id="actives" name="actives" class="input" value="<?php echo $json_array['actives']; ?>" />
			</div>
			<div class="col4 omega">
				<label for="zone">Zone:</label>
				<input type="text" id="zone" name="zone" class="input" value="<?php echo $json_array['zone']; ?>" />
			</div>
		</li>

		<hr class="fade" />
		The last recorder state of the GPIO. (-1 indicated the GPIO is not used by the ESP device).
		<hr class="fade" />

		<li>
			<div class="col8">
				<label for="gpio0">GPIO 0:</label>
				<input type="text" id="gpio0" name="gpio0" class="input" style="text-align: right;" value="<?php echo $json_array['gpio0']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio1">GPIO 1:</label>
				<input type="text" id="gpio1" name="gpio1" class="input" style="text-align: right;" value="<?php echo $json_array['gpio1']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio2">GPIO 2:</label>
				<input type="text" id="gpio2" name="gpio2" class="input" style="text-align: right;" value="<?php echo $json_array['gpio2']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio3">GPIO 3:</label>
				<input type="text" id="gpio3" name="gpio3" class="input" style="text-align: right;" value="<?php echo $json_array['gpio3']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio4">GPIO 4:</label>
				<input type="text" id="gpio4" name="gpio4" class="input" style="text-align: right;" value="<?php echo $json_array['gpio4']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio5">GPIO 5:</label>
				<input type="text" id="gpio5" name="gpio5" class="input" style="text-align: right;" value="<?php echo $json_array['gpio5']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio9">GPIO 9:</label>
				<input type="text" id="gpio9" name="gpio9" class="input" style="text-align: right;" value="<?php echo $json_array['gpio9']; ?>" />
			</div>
		</li>
		<li>

			<div class="col8">
				<label for="gpio10">GPIO 10:</label>
				<input type="text" id="gpio10" name="gpio10" class="input" style="text-align: right;" value="<?php echo $json_array['gpio10']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio12">GPIO 12:</label>
				<input type="text" id="gpio12" name="gpio12" class="input" style="text-align: right;" value="<?php echo $json_array['gpio12']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio13">GPIO 13:</label>
				<input type="text" id="gpio13" name="gpio13" class="input" style="text-align: right;" value="<?php echo $json_array['gpio13']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio14">GPIO 14:</label>
				<input type="text" id="gpio14" name="gpio14" class="input" style="text-align: right;" value="<?php echo $json_array['gpio14']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio15">GPIO 15:</label>
				<input type="text" id="gpio15" name="gpio15" class="input" style="text-align: right;" value="<?php echo $json_array['gpio15']; ?>" />
			</div>
			<div class="col8">
				<label for="gpio16">GPIO 16:</label>
				<input type="text" id="gpio16" name="gpio16" class="input" style="text-align: right;" value="<?php echo $json_array['gpio16']; ?>" />
			</div>
			<div class="col8">
				<label for="adc">ADC:</label>
				<input type="text" id="adc" name="adc" class="input" style="text-align: right;" value="<?php echo $json_array['adc']; ?>" />
			</div>
		</li>
	</ul>
		<fieldset class="submit-buttons">
			<input hidden class="post"  id="mode" name="mode" value="save" type="text">
			<input class="button1" type="submit" id="submit" name="submit" value="Save Changes" />&nbsp;
			<input class="button2" type="reset" id="reset" name="reset" value="Reset" />&nbsp;
		</fieldset>
</form>
</div>


<?php

include('footer.html');
