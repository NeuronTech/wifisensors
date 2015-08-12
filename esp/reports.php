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
include_once('includes/functions.php');

$json_arrays = get_data(0, true);

include('header.html');
include('left_blocks.html');
?>
<h4 style="margin:3px; margin-bottom:10px;">Full list of sensors (press associated gear icon to edit).</h4>
<div class="xbox" style="margin:0;">
	<table class="ttable">
		<tr>
			<th title="Location in house">Location</th>
			<th style="text-align:center" title="Active/Inactive">A</th>
			<th style="text-align:center">ID</th>
			<th style="text-align:center">Zone</th>
			<th style="text-align:center">Chan</th>
			<th style="text-align:center" title="Last activated">Record (Time)</th>
			<th style="text-align:center" title="Last activated">Date</th>
			<th style="text-align:center" title="Sensor level">Sen</th>
			<th style="text-align:center" title="Alarm treshold">Tre</th>
			<th style="text-align:center" title="Battery voltage">Bat</th>
			<th style="text-align:center; font-size:14px" title="Total activations">♪</th>
			<th class="editicon"><img src="./../images/icon_edit.gif"></th>
		</tr>
<?php foreach($json_arrays as $json_array) { ?>
		<tr>
			<td style=""><?php echo $json_array['location']; ?></td>
			<td style="text-align:center;"><?php echo $json_array['status'] ? '✔' : '✖'; ?></td>
			<td style="text-align:right;"><?php echo $json_array['esp']; ?></td>
			<td style="text-align:right;"><?php echo $json_array['zone']; ?></td>
			<td style="text-align:right;"><?php echo $json_array['chan']; ?></td>
			<td style="text-align:center"><?php echo $json_array['time']; ?></td>
			<td style="text-align:center"><?php echo $json_array['date']; ?></td>
			<td style="text-align:right;"><?php echo $json_array['level']; ?></td>
			<td style="text-align:right;"><?php echo $json_array['tresh']; ?></td>
			<td style="text-align:right;"><?php echo $json_array['batt']; ?></td>
			<td style="text-align:right;"><?php echo $json_array['actives']; ?></td>
			<td class="editicon"><a title="Click to Edit Sensor Details" href="index.php?esp_id=<?php echo $json_array['esp']; ?>"><img src="./../images/icon_edit.gif"></a></td>
		</tr>
<?php } ?>
	</table>
</div>

<?php

include('footer.html');
