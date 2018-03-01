<?php

	$root_path = (defined('ROOT_PATH')) ? ROOT_PATH : './';
	$phpEx = substr(strrchr(__FILE__, '.'), 1);

	if (file_exists($root_path . 'config.' . $phpEx))
	{
		require($root_path . 'config.' . $phpEx);
	}
?>