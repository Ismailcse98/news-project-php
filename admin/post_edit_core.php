<?php
include 'config.php';
if(isset($_POST['update'])){
	$id = $_POST['id'];
	$post_title = $_POST['post_title'];
	$postdesc = $_POST['postdesc'];
	$category = $_POST['category'];
	$oldCategory = $_POST['oldCategory'];
	$oldFile = $_POST['oldFile'];
	if(empty($_FILES['newFile']['name'])){
		$newName = $oldFile;
	}else{
		$error = array();
		$filename = $_FILES['newFile']['name'];
		$filetmpname = $_FILES['newFile']['tmp_name'];
		$filesize = $_FILES['newFile']['size'];
		$fileExplode = explode('.', $filename);
		$fileExt = end($fileExplode);
		$extensions = array("jpg","png","jpeg");
		$newName = time()."-".basename($filename);
		$target = "uploads/".$newName;
		if(in_array($fileExt, $extensions)==false){
			$error[]="This extensions file is not allowed";
		}
		if($filesize>2097152){
			$error[]="File size must be 2 md or lower";
		}
		if(empty($error)==true){
			move_uploaded_file($filetmpname, $target);
			unlink("uploads/".$oldFile);
		}else{
			print_r($error);
		}
	}

	$sql = "UPDATE post SET title='$post_title',description='$postdesc',category='$category',post_img='$newName' WHERE post_id = '$id';";
	if($category != $oldCategory){
		$sql .="UPDATE category SET total_post = total_post - 1 WHERE category_id = '$oldCategory';";
	}else{
		$sql .="UPDATE category SET total_post = total_post + 1 WHERE category_id = '$category'";
	}
	$reslut = mysqli_multi_query($con,$sql);
	if($reslut){
		header('Location:post.php');
	}else{
		echo "Query Field";
	}
}

?>