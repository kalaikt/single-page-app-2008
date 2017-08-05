<?php 
	include'config.inc';
	$tot_pages=mysql_num_rows(mysql_query($_REQUEST['sql']));
	echo $pages=($tot_pages%$_POST['p_page'])>0?floor($tot_pages/$_POST['p_page'])+1:floor($tot_pages/$_POST['p_page']);
?>