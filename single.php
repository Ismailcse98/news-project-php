<?php
include 'header.php';
include 'admin/config.php';
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM post
    LEFT JOIN category ON post.category = category.category_id
    LEFT JOIN user ON post.author = user.user_id  WHERE post_id ='$id'";
    $res = mysqli_query($con,$sql);
    if($res){
        $data = mysqli_fetch_assoc($res);
?>
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $data['title']?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?cat_id=<?php echo $data['category_id']?>"><?php echo $data['category_name'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?auth_id=<?php echo $data["user_id"]?>'>
                                        <?php echo $data['username'];?>
                                    </a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $data['post_date'];?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/uploads/<?php echo $data['post_img']?>" alt=""/>
                            <p class="description">
                              <?php echo $data['description']; ?>
                            </p>
                        </div>
                    </div>
<?php } } ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
