<?php
	
	ini_set('display_errors',true);
	ini_set('display_errors','on');
	define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT'].'/peopleu');
	define('DB_HOST','localhost');
	define('DB_USER_NAME','root');
	define('DB_PASSWORD','');
	define('DB','peopleu');
	
# Start Session
	include_once('session_start.php');
	
# Include DB Connection File	
	include('adodb/adodb.inc.php');


# Initialize Smarty
	require('smarty/libs/Smarty.class.php');
	$smarty = new Smarty();
	$smarty->template_dir = SITE_ROOT.'/includes/smarty/templates';
	$smarty->compile_dir = SITE_ROOT.'/includes/smarty/templates_c';
	$smarty->cache_dir = SITE_ROOT.'/includes/smarty/cache';
	$smarty->config_dir = SITE_ROOT.'/includes/smarty/configs';
?>
