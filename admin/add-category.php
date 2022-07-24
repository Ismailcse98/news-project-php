<?php
include "header.php";
include "config.php";
if($_SESSION['user_role']==0){
  header("Location:post.php");
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php 
                if(isset($_POST['save'])){
                  $category_name = mysqli_real_escape_string($con,$_POST['cat']);
                  $sql = "SELECT * FROM category WHERE category_name = '$category_name'";
                  $res = mysqli_query($con,$sql);
                  if(mysqli_num_rows($res)>0){
                    echo "Category name is already Exits";
                  }else{
                    $insertSql ="INSERT INTO category (category_name) VALUES('$category_name')";
                    $insertresult = mysqli_query($con,$insertSql);
                    if($insertresult){
                      header('Location:category.php');
                    }
                  }
                }
                ?>
                  <!-- Form Start -->
                  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
