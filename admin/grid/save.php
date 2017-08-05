<?php
	include'config.inc';
	$field_list = explode('|',$_POST['field_list']);
	$update = array();
	$insert = array();
	foreach($field_list as $key=>$value){
		if($_POST['field_password'] == $value and $_POST['password_encrypt']){
			$insert[] = "'".md5(trim($_POST[$value]))."'";
		}else{
			$insert[] = "'".$_POST[$value]."'";
		}
		
	}
	print_r($_POST);
	$fld_unshown = explode(',',$_POST['fields_unshow']);
	//print_r($fld_unshown);
	foreach(explode('|',$_POST['field_list']) as $key=>$value){
		if($value == $_POST['field'] or in_array($value,$fld_unshown)) continue;
		$update[] =" ".$value." = '".$_POST[$value]."'";
	}
	if($_POST['mode']){
		$sql='UPDATE '.$_POST['tbl_name'].' SET '.implode(', ',$update).' WHERE '.$_POST['field'].' = "'.$_POST[$_POST['field']].'"';
		
	}
	else{
		echo $sql = 'INSERT INTO '.$_POST['tbl_name'].' ('.implode(', ',$field_list).') VALUES ('.str_replace("'NOW()'",'NOW()',implode(', ',$insert)).')';
	}
	mysql_query($sql);
	
?>
