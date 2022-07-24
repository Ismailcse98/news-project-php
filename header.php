<?php
include "admin/config.php";
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
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <li><a href="index.php">Home</a></li>
                <?php
                $sql = "SELECT * FROM category WHERE total_post > 0";
                $res = mysqli_query($con,$sql);
                $count = mysqli_num_rows($res);
                $active = "";
                if($count>0){
                    while ($data = mysqli_fetch_assoc($res)) {
                        $id = $data['category_id'];
                    if(isset($_GET['cat_id'])){
                        $cat_id = $_GET['cat_id'];
                        if($id == $cat_id){
                            $active="active";
                        }else{
                            $active=" ";
                        }
                     }
                ?>
                    <li><a class="<?php echo $active;?>" href='category.php?cat_id=<?php echo $id?>'><?php echo $data['category_name']?></a></li>
                <?php  } } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
