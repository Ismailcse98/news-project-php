<?php 
include "config.php";
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$catId = $_GET['catId'];

	$ImgDelSql = "SELECT * FROM post WHERE post_id ='$id'";
	$ImgdelRes = mysqli_query($con,$ImgDelSql);
	$rows = mysqli_fetch_assoc($ImgdelRes);
	unlink("uploads/".$rows['post_img']);

	$sql = "DELETE FROM post WHERE post_id = '$id';";
	$sql .= "UPDATE category SET total_post = total_post -1 WHERE category_id='$catId'";
	$res = mysqli_multi_query($con,$sql);
	if($res){
		header("Location:post.php");
	}else{
		echo "Query Field";
	}
}


?>