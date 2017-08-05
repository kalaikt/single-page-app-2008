<?php
/**
 * This file uploads a file in the back end, without refreshing the page
 *  
 */

@session_start();
if (isset($_POST['id'])) {
	$uploadFile=$_GET['dirname']."/".$_FILES[$_POST['id']]['name'];
	if(!is_dir($_GET['dirname'])) {
		echo '<script> alert("Failed to find the final upload directory: "+'.$_GET['dirname'].');</script>';
	}
	$uploadedfile = $_FILES[$_POST['id']]['tmp_name'];

	$ext = explode('.',$_FILES[$_POST['id']]['name']);
	if($ext[1]=='gif' || $ext[1]=='GIF'){
		$src = imagecreatefromgif($uploadedfile);
	}
	else{
		$src = imagecreatefromjpeg($uploadedfile);
	}
	
	list($width,$height)=getimagesize($uploadedfile);
	
	$mini_size = 150;
	if($height<$width){
		$newwidth=$mini_size;
		$newheight=($height/$width)*$mini_size;
	}
	else{
		$newwidth=($width/$height)*$mini_size;
		$newheight=$mini_size;
	}
	
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	
	// this line actually does the image resizing, copying from the original
	// image into the $tmp image
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	
	// now write the resized image to disk. I have assumed that you want the
	// resized, uploaded image file to reside in the ./images subdirectory.
	$filename = "../images/". $_POST['f_name'].''. $_FILES[$_POST['id']]['name'];
	
	
	if($ext[1]=='gif' || $ext[1]=='GIF')
		imagegif($tmp,$filename,100);
	else
		imagejpeg($tmp,$filename,100);
		
	imagedestroy($src);
	imagedestroy($tmp);
	
	//if (!move_uploaded_file($_FILES[$_POST['id']]['tmp_name'], $filename)) {	
	/*//echo '<script> alert("Failed to upload file");</script>';*/
//	}
}
else {
	$uploadFile=$_GET['dirname']."/".$_GET['filename'];
	if (file_exists($uploadFile)) {
		echo "<a href='$uploadFile' target='_blank'>Open File</a> &nbsp;&nbsp;&nbsp; <a href='javascript:void(0)' onclick='people.deleteFile(\"filename=".$_GET['filename']."\");'><img src='../images/delete.png'/></a><input type='hidden' name='title_image' id='title_image' value='".$_GET['filename']."'>";	
	}
	else {
		echo "<img src='loading.gif' alt='loading...' />";
	}
}
?>