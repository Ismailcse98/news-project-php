<?php 
session_start();
if(!isset($_SESSION['username'])){
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News Site</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <li><a href='post.php'>Post</a></li>
                <?php if($_SESSION['user_role']==1){?>
                    <li><a href='category.php'>Category</a></li>
                    <li><a href='users.php'>Users</a></li>
                <?php } ?>
                    <li><a href='logout.php'>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
