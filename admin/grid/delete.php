<?php
	include'config.inc';
	
	mysql_query('DELETE FROM '.$_POST['tbl_name'].' WHERE '.$_POST['field'].' = "'.str_replace('|','" OR '.$_POST['field'].' = "',$_POST['id']).'"');
	
?>
