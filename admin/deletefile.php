<?php
/**
 * This file uploads a file in the back end, without refreshing the page
 *  
 */
require('../includes/mainInclude.php');
require_once("../includes/libs/AjaxFileUploader.class.php");
require('../includes/libs/PeopleU.class.php');
$pu = new PeopleU();
$uploadDirectory = "../images/";
$ajax= new AjaxFileuploader($uploadDirectory);	
$homepage="?p=".$_GET['p'];
if (is_file($_GET['filename'])) {	
	if (unlink($_GET['filename'])) {
		echo $ajax->showFileUploader('upload');
		$file = explode('/',$_GET['filename']);
		$pu->update('news', array('image'=>''),' image ="'.$file[count($file)-1].'"');
	}
	else {
		echo "<script type='text/javascript'> alert('Failed to delete: ".$_GET['filename'].". Please try again.');</script>";
	}
}
else {
	echo $ajax->showFileUploader('upload');
}
?>