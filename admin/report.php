<?php
	ob_start();
	require('../includes/mainInclude.php');
	require('../includes/libs/PeopleU.class.php');
	$pu = new PeopleU();
	$pu->getReport();
	
?>
