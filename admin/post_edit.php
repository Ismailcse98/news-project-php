<?php
include "header.php";
include "config.php";
?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <?php 
                  if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM post
                    LEFT JOIN category ON post.category = category.category_id
                    WHERE post_id = $id";
                    $res = mysqli_query($con,$sql);
                    $count = mysqli_num_rows($res);
                    if($count>0){
                      while($data = mysqli_fetch_assoc($res)){
                  ?>
                  <form  action="post_edit_core.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" value="<?php echo $data['title']?>" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required>
                            <?php echo $data['description']?>
                          </textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                            <option disabled> Select Category</option>
                            <?php 
                            $sql = "SELECT * FROM category";
                            $res = mysqli_query($con,$sql);
                            if(mysqli_num_rows($res)>0){
                              while ($rows = mysqli_fetch_assoc($res)) {
                                $cat_id = $rows['category_id'];
                                $category_name = $rows['category_name'];
                                if($data['category']==$cat_id){
                                  $selected = "selected";
                                }else{
                                  $selected = "";
                                }
                                echo "<option {$selected} value='{$cat_id}'>{$category_name}</option>";
                              }
                            }
                            ?>
                          </select>
                          <input type="hidden" name="oldCategory" value="<?php echo $data['category'];?>">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="newFile">
                          <img src="uploads/<?php echo $data['post_img'];?>" alt="" width="150px">
                          <input type="hidden" name="oldFile" value="<?php echo $data['post_img'];?>">
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="update" />
                  </form>
                <?php  } } } ?>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
