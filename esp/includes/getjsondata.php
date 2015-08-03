<?php
define('IN_CODE', true);
include('functions.php');
global $json_array;

$json_array = get_data();
echo(json_encode($json_array));
