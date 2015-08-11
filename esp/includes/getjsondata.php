<?php
define('IN_CODE', true);
include('functions.php');
global $json_array;
$json_array = get_data(0,false);
echo(json_encode($json_array));
