<?php
$root_path = (defined('ROOT_PATH')) ? ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

if (file_exists($root_path . 'config.' . $phpEx))
{
	require($root_path . 'config.' . $phpEx);
}

global $hostname, $username, $password, $database;

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect($hostname, $username, $password);

// Selecting Database
$db = mysql_select_db($database, $connection);
session_start();

// Storing Session
$user_check=$_SESSION['login_user'];

// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select username from login where username='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session = $row['username'];

if(!isset($login_session))
{
	mysql_close($connection);
	header('Location: index.php');
}
?>