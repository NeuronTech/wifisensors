<?php
define('IN_CODE', true);
include('functions.php');
$json_array = get_record(0, 0, false);
echo(json_encode($json_array));