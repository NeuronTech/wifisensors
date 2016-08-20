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

echo '<link rel="stylesheet" type="text/css" href="resources/style.css" />';


include('header.html');
include('left_blocks.html');
?>

<div id="floorplan3d"><br /></div>

<?php
include('footer.html');
