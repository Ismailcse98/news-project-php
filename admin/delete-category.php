<?php 
include "config.php";
if($_SESSION['user_role']==0){
  header("Location:post.php");
}
if(isset($_GET['id'])){
	$id =  $_GET['id'];
	$sql = "DELETE FROM category WHERE category_id = '$id'" or die('Query field');
	$res = mysqli_query($con,$sql);
	if($res){
		header('Location:category.php');
	}
}

?>