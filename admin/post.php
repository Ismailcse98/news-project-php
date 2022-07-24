<?php
include "header.php";
include "config.php";
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">

                  <table class="content-table">
                      <thead>
                          <tr>
                            <th>S.No.</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Edit</th>
                          <th>Delete</th>
                          </tr>
                      </thead>
                      <tbody>
                    <?php
                    $userId =  $_SESSION['user_id'];
                    if($_SESSION['user_role'] == 1){
                        $sql = "SELECT post.post_id,post.title,post.post_date,post.post_img, category.category_id, category.category_name,user.username FROM post 
                      LEFT JOIN category ON post.category = category.category_id
                      LEFT JOIN user ON post.author = user.user_id ORDER BY post_id DESC";
                    }else{
                      $sql = "SELECT post.post_id,post.title,post.post_date,post.post_img, category.category_id,category.category_name,user.username FROM post 
                    LEFT JOIN category ON post.category = category.category_id
                    LEFT JOIN user ON post.author = user.user_id WHERE user.user_id='$userId' ORDER BY post_id DESC";
                    }
                    $res = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($res);
                    if($count>0){
                      $sl=1;
                      while ($rows = mysqli_fetch_assoc($res)) {
                    ?>
                          <tr>
                            <td><?php echo $sl++;?></td>
                            <td><img src="uploads/<?php echo $rows['post_img']?>" width="50px" alt=""></td>
                            <td><?php echo $rows['title'];?></td>
                            <td><?php echo $rows['category_name']?></td>
                            <td><?php echo $rows['post_date']?></td>
                            <td><?php echo $rows['username']?></td>
                            <td><a href="post_edit.php?id=<?php echo $rows['post_id'];?>"><i class='fa fa-edit'></i></a></td>
                            <td><a onclick="return confirm('Are you sure??')" href="post_delete.php?id=<?php echo $rows['post_id'];?>&catId=<?php echo $rows['category_id']?>"><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                <?php } } ?>
                      </tbody>
                  </table>
                  <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
