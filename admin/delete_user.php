<?php
include "config.php";
if($_SESSION['user_role']==0){
  header("Location:post.php");
}

$id = $_GET['id'];
$sql = "DELETE FROM user WHERE user_id = '$id'";
$result = mysqli_query($con, $sql);
if($result){
	header("Location:users.php");
}
?>