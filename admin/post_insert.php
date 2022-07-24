<?php
include "config.php";
session_start();
if(isset($_POST['submit'])){
	$post_title = mysqli_real_escape_string($con,$_POST['post_title']);
	$postdesc = mysqli_real_escape_string($con,$_POST['postdesc']);
	$category = mysqli_real_escape_string($con,$_POST['category']);
	$date = date('d M,Y');
	$author = $_SESSION['user_id'];

// File Information
	$errors = array();
	$extensions = array('jpg','png','jpeg');
	$fileToUpload = $_FILES['fileToUpload'];
	$filename = $fileToUpload['name'];
	$filetmpname = $fileToUpload['tmp_name'];
	$filesize = $fileToUpload['size'];
	$filenameExp = explode('.', $filename);
	$filenameExt = end($filenameExp);
	$newfilename = time().'-'.basename($filename);
	$target = "uploads/".$newfilename;

	if(in_array($filenameExt, $extensions)==false){
		$errors[] = "This extensions file not allowed";
	}
	if($filesize>2097152){
		$errors[] = "File size must be 2 mb or lower";
	}
	if(empty($errors) == true){
		move_uploaded_file($filetmpname, $target);
	}else{
		print_r($errors);
	}
// Sql Code
	$sql = "INSERT INTO post (title,description,category,post_date,author,post_img) VALUES('$post_title','$postdesc','$category','$date','$author','$newfilename');";
	$sql .= "UPDATE category SET total_post = total_post + 1 WHERE category_id = '$category'";
	$res = mysqli_multi_query($con, $sql);
	if($res){
		header('Location:post.php');
	}else{
		echo "<span class='danger'>Query Field</span>";
	}
}
?>