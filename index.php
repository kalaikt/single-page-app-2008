<?php
	require('includes/mainInclude.php');
	require('includes/libs/PeopleU.class.php');
	$pu = new PeopleU();
	
	//$smarty->assign('pu',$cw);
	$smarty->assign('q_str',$_SERVER['QUERY_STRING']);
	$smarty->assign('pu',$pu);
	$content = isset($_GET['tpl'])?is_file("includes/smarty/templates/default/".$_GET['tpl'].".tpl")?$_GET['tpl'].".tpl":"main.tpl":"main.tpl";
	if(isset($_GET['tpl'])){
		$_SESSION['content'] = $content;
	}
	else if($_SESSION['content']){
		$content = $_SESSION['content'];
	}
	if(isset($_POST['flag'])){
		$smarty->display('default/'.$content);
	}
	else{
		$smarty->assign("content",$content);
		$smarty->display('default/index.tpl');
	}
?>
