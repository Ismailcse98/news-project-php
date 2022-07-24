<?php
include 'header.php';
include 'admin/config.php';
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
<?php 
$sql = "SELECT * FROM post 
LEFT JOIN category ON post.category = category.category_id
LEFT JOIN user ON post.author = user.user_id";
$res = mysqli_query($con,$sql);
$count = mysqli_num_rows($res);
if($count>0){
    while ($data = mysqli_fetch_assoc($res)) {
?>
                        <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href='single.php?id=<?php echo $data["post_id"]?>'>
                                    <img src="admin/uploads/<?php echo $data['post_img']?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $data["post_id"]?>'><?php echo $data['title']?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cat_id=<?php echo $data["category_id"]?>'><?php echo $data['category_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?auth_id=<?php echo $data["user_id"]?>'><?php echo $data['username']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $data['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php 
                                       echo substr($data['description'], 0,149)."...";
                                        ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $data["post_id"]?>'>Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php 
  }
}
?>
                        <ul class='pagination'>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                        </ul>
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
