<?php
	ob_start();
	require('../includes/mainInclude.php');
	require('../includes/libs/PeopleU.class.php');
	require_once("../includes/libs/AjaxFileUploader.class.php");
	$pu = new PeopleU();
	$uploadDirectory = "../images/";
	$ajaxFileUploader = new AjaxFileuploader($uploadDirectory);	
	/*echo $ajaxFileUploader->showFileUploader('id1');
	echo $ajaxFileUploader->showFileUploader('id2');
	echo $ajaxFileUploader->showFileUploader('id4');*/
	isset($_GET['logout']) and $pu->setLogout();
	$smarty->assign('pu',$pu);
	$smarty->assign('ajax',$ajaxFileUploader);
	$smarty->assign('parent_id',isset($_POST['parent_id'])?$_POST['parent_id']:0);
	$smarty->assign('q_str',$_SERVER['QUERY_STRING']);
	$smarty->assign("content",isset($_GET['p'])?is_file("../includes/smarty/templates/default/admin/".$_GET['p'].".tpl")?$_GET['p'].".tpl":"main.tpl":"main.tpl");
	$_GET['tpl_name'] = $_GET['p'].".tpl";
	$smarty->display('default/admin/index.tpl');
?>
