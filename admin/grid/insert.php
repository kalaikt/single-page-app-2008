<?php
	include'config.inc';
	mysql_query('INSERT INTO '.$_POST['tbl_name'].' ('.$_POST['field'].') VALUES ("")');
	
?>
