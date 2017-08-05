<?php
	ob_start();
	require('../includes/mainInclude.php');
	require('../includes/libs/PeopleU.class.php');
	require_once("../includes/libs/AjaxFileUploader.class.php");
	$uploadDirectory = "../images/";
	
	$pu = new PeopleU();
	$ajaxFileUploader = new AjaxFileuploader($uploadDirectory);	
	if(isset($_GET['add_image'])){
		echo $ajaxFileUploader->showFileUploader('upload1');
		exit;
	}
	$smarty->assign('ajax',$ajaxFileUploader);
	$smarty->assign('pu',$pu);
	isset($_POST['news_id']) and !isset($_POST['title']) and $smarty->assign('newsdata',$pu->getNews($_POST['news_id']));
	$smarty->assign('parent_id',isset($_POST['parent_id'])?$_POST['parent_id']:0);
	$smarty->display('default/admin/'.$_GET['tpl_name']);
?>
