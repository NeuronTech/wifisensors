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
include($root_path . 'includes/database.' . $phpEx);
include($root_path . 'includes/functions_main.' . $phpEx);

$auth = $_SESSION['auth'];
$submit = request_var('submit', '');
$redirect = request_var('redirect', false);
$user = request_var('user', '');
$pass = request_var('pass', '');
$error = request_var('error', '');


if ($submit)
{
	if (empty($user) || empty($pass))
	{
		$error = "... the information is invalid ...";
		//set_var($error, $error, 'string');
		header("location: login.php?error=" . $error . "&user=" . $user);
		exit;
	}
	else
	{
		$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("Unable to connect to MySQL");
		$selected = mysqli_select_db($dbhandle, $database);
		if(!$selected)
		{
			die("30 Could not select devices table");
		}

		// To protect MySQL injection for Security purpose
		$user = stripslashes($user);
		$pass = stripslashes($pass);
		$user = mysqli_real_escape_string($dbhandle, $user);
		$pass = mysqli_real_escape_string($dbhandle, $pass);

		$passenc = hash("sha256", $pass);
		var_dump($passenc);

		$esp_login = $database . '.login';

		$sql = "SELECT user, pass, auth
		FROM $esp.login
		WHERE user = '" . $user . "' and pass = '" . $pass . "' and auth = 1";

		$result = mysqli_query($dbhandle, $sql) or die("Error: " . mysqli_error($dbhandle));
		$rows = mysqli_fetch_row($result);

		mysqli_free_result($result);
		mysqli_close($dbhandle);

		if ($rows)
		{
			$_SESSION['user'] = $rows[0];
			$_SESSION['pass'] = $rows[1];
			$_SESSION['auth'] = $rows[2];
			header("location: index.php");
			exit;
		}
		else
		{
			$error = "Username or Password is invalid...";
			header("location: login.php?error=" . $error . "&user=" . $user);
			exit;
		}
	}
}
else
{
	include('header.html');
	include('left_blocks.html');
?>
	<div class="formLayout">
		<h2 style="text-align:center">Welcome to ESP Web Server</h2>
		<hr class="fade" /><br />
		<form method="post" action="login.php" >
			<div>
				<label>User name: </label>
				<input name="user" type="text" placeholder="" size="20" value="<?php echo (isset($user)) ? $user : '' ?>" />
				<label>Password: </label>
				<input name="pass" type="password" placeholder="" size="10" value="<?php echo (isset($pass)) ? $pass : '' ?>" />
			</div>
			<div style="clear:both; text-align:center">
				<input name="submit" type="submit" class="btn" value=" Login " />
			</div>
			<div style="clear:both; text-align:center">
				<span style="font-size: 1.1em; color:#FF0000">
					<?php echo (isset($error)) ? $error : '' ?>
				</span>
			</div>
		</form>
	</div>
<?php
	include('footer.html');
}

?>