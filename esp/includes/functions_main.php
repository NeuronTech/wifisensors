<?php
// main code for testing ESP8266 //

if (!defined('IN_CODE'))
{
	exit;
}

function start()
{
	$data = request_var('data', '');
	return($data);
}


/**
* Code in this file is mainly from phpBB forum software.
* copyright (c) 2005 phpBB Group
* license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/


/**
* set_var
*
* Set variable, used by {@link request_var the request_var function}
*
* @access private
*/
function set_var(&$result, $var, $type, $multibyte = false)
{
	settype($var, $type);
	$result = $var;

	if ($type == 'string')
	{
		$result = trim(htmlspecialchars(str_replace(array("\r\n", "\r", "\0"), array("\n", "\n", ''), $result), ENT_COMPAT, 'UTF-8'));

		if (!empty($result))
		{
			// Make sure multibyte characters are wellformed
			if ($multibyte)
			{
				if (!preg_match('/^./u', $result))
				{
					$result = '';
				}
			}
			else
			{
				// no multibyte, allow only ASCII (0-127)
				$result = preg_replace('/[\x80-\xFF]/', '?', $result);
			}
		}

		// error bug? //$result = (STRIP) ? stripslashes($result) : $result;
		$result = (true) ? stripslashes($result) : $result;
	}
}

/**
* request_var
*
* Used to get passed variable
*/
function request_var($var_name, $default, $multibyte = false, $cookie = false)
{
	if (!$cookie && isset($_COOKIE[$var_name]))
	{
		if (!isset($_GET[$var_name]) && !isset($_POST[$var_name]))
		{
			return (is_array($default)) ? array() : $default;
		}
		$_REQUEST[$var_name] = isset($_POST[$var_name]) ? $_POST[$var_name] : $_GET[$var_name];
	}

	$super_global = ($cookie) ? '_COOKIE' : '_REQUEST';
	if (!isset($GLOBALS[$super_global][$var_name]) || is_array($GLOBALS[$super_global][$var_name]) != is_array($default))
	{
		return (is_array($default)) ? array() : $default;
	}

	$var = $GLOBALS[$super_global][$var_name];
	if (!is_array($default))
	{
		$type = gettype($default);
	}
	else
	{
		list($key_type, $type) = each($default);
		$type = gettype($type);
		$key_type = gettype($key_type);
		if ($type == 'array')
		{
			reset($default);
			$default = current($default);
			list($sub_key_type, $sub_type) = each($default);
			$sub_type = gettype($sub_type);
			$sub_type = ($sub_type == 'array') ? 'NULL' : $sub_type;
			$sub_key_type = gettype($sub_key_type);
		}
	}

	if (is_array($var))
	{
		$_var = $var;
		$var = array();

		foreach ($_var as $k => $v)
		{
			set_var($k, $k, $key_type);
			if ($type == 'array' && is_array($v))
			{
				foreach ($v as $_k => $_v)
				{
					if (is_array($_v))
					{
						$_v = null;
					}
					set_var($_k, $_k, $sub_key_type, $multibyte);
					set_var($var[$k][$_k], $_v, $sub_type, $multibyte);
				}
			}
			else
			{
				if ($type == 'array' || is_array($v))
				{
					$v = null;
				}
				set_var($var[$k], $v, $type, $multibyte);
			}
		}
	}
	else
	{
		set_var($var, $var, $type, $multibyte);
	}

	return $var;
}


/**
 copyright phpbb.com
*/
function meta_refresh($time, $url, $disable_cd_check = false)
{
	global $template, $refresh_data, $request;

	$url = redirect($url, true, $disable_cd_check);
	if ($request->is_ajax())
	{
		$refresh_data = array(
			'time'	=> $time,
			'url'	=> $url,
		);
	}
	else
	{
		// For XHTML compatibility we change back & to &amp;
		$url = str_replace('&', '&amp;', $url);

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="' . $time . '; url=' . $url . '" />')
		);
	}

	return $url;
}


function redirect($url, $return = false, $disable_cd_check = false)
{
	header('Location: ' . $url);
	exit;
}