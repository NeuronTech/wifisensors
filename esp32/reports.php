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

include_once($root_path . 'common.' . $phpEx);
include_once($root_path . 'includes/functions_main.' . $phpEx);
include_once('includes/functions.php');

if (!$auth)
{
	header('Location: login.php');
	exit;
}

$json_arrays = get_record(0, 0, true);

include('partial/header.html');

?>

<form id="esp_reports" name="esp_reports" method="post" action="edit.php?action=submit">
	<h4 style="margin:3px; margin-bottom:10px;">Full list of sensors (press associated gear icon to edit).</h4>
	<div class="xbox" style="margin:0;">
		<table class="ttable">
			<tr>
				<th title="Location in house">Location</th>
				<th style="text-align:center" title="Active/Inactive">A</th>
				<th style="text-align:center">ID</th>
				<th style="text-align:center">IP</th>
				<th style="text-align:center">Type</th>
				<th style="text-align:center">Zone</th>
				<th style="text-align:center">Chan</th>
				<th style="text-align:center" title="Last activated">Record (Time)</th>
				<th style="text-align:center" title="Last activated">Date</th>
				<th style="text-align:center" title="Signal Level">RSSI</th>
				<th style="text-align:center" title="ADC Treshold">Tresh</th>
				<th style="text-align:center" title="ADC Value">Val</th>
				<th style="text-align:center" title="Battery voltage">Bat</th>
				<th style="text-align:center;" title="Total activations">♪</th>
				<th style="text-align:center;" title="GPIO0">0</th>
				<th style="text-align:center;" title="GPIO1">1</th>
				<th style="text-align:center;" title="GPIO2">2</th>
				<th style="text-align:center;" title="GPIO3">3</th>
				<th style="text-align:center;" title="GPIO4">4</th>
				<th style="text-align:center;" title="GPIO5">5</th>
				<th style="text-align:center;" title="GPIO6">6</th>
				<th style="text-align:center;" title="GPIO7">7</th>
				<th style="text-align:center;" title="GPIO8">8</th>
				<th style="text-align:center;" title="GPIO9">9</th>
				<th style="text-align:center;" title="GPIO10">10</th>
				<th style="text-align:center;" title="GPIO11">11</th>
				<th style="text-align:center;" title="GPIO12">12</th>
				<th style="text-align:center;" title="GPIO13">13</th>
				<th style="text-align:center;" title="GPIO14">14</th>
				<th style="text-align:center;" title="GPIO15">15</th>
				<th style="text-align:center;" title="GPIO16">16</th>
				<th class="editicon"><img src="images/icon_edit.gif"></th>
			</tr>

<?php foreach($json_arrays as $json_array) { ?>
<?php
			if($json_array['ip'] == "0.0.0.0")
			{
				echo '<tr class="client">';
			}
			else
			{
				echo '<tr class="server">';
			}
?>
				<td style=""><?php echo $json_array['location']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['status'] ? '✔' : '✖'; ?></td>
				<td style="text-align:right;"><?php echo $json_array['id']; ?></td>
				<td style="text-align:right;"><?php echo $json_array['ip']; ?></td>
				<td style="text-align:right;"><?php echo $json_array['type']; ?></td>
				<td style="text-align:right;"><?php echo $json_array['zone']; ?></td>
				<td style="text-align:right;"><?php echo $json_array['chan']; ?></td>
				<td style="text-align:center"><?php echo $json_array['time']; ?></td>
				<td style="text-align:center"><?php echo $json_array['date']; ?></td>
				<td style="text-align:right;"><?php echo $json_array['rssi']; ?></td>
				<td style="text-align:right;"><?php echo $json_array['adc_read']; ?></td>
				<td style="text-align:right;"><?php echo $json_array['adc_trig']; ?></td>
				<td style="text-align:right;"><?php echo $json_array['batt']; ?></td>
				<td style="text-align:right;"><?php echo $json_array['actives']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio0']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio1']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio2']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio3']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio4']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio5']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio0']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio9']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio8']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio9']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio10']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio11']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio12']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio13']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio14']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio15']; ?></td>
				<td style="text-align:center;"><?php echo $json_array['gpio16']; ?></td>
				<td class="editicon">
					<input hidden class="post"  id="id" name="id" value="<?php echo $json_array['id']; ?>" type="text">
					<input hidden class="post"  id="mode" name="mode" value="edit" type="text">
					<a href="edit.php?id=<?php echo $json_array['id']; ?>" title="Click to Edit Sensor Details"><img src="images/icon_edit.gif"></a>
				</td>
<?php } ?>
			</tr>
		</table>
	</div>
</form>
<?php

include('partial/footer.html');
