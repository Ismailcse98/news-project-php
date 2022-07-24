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
                if(isset($_POST['update'])){
                  $category_id = $_POST['id'];
                  $category_name = mysqli_real_escape_string($con,$_POST['cat']);
                  $updateSql = "UPDATE category SET category_name = '$category_name' WHERE category_id='$category_id '";
                  $updateRes = mysqli_query($con,$updateSql);
                  if($updateRes){
                    header('Location:category.php');
                  }
                }
                if(isset($_GET['id'])){
                  $id = $_GET['id'];
                  $sql = "SELECT * FROM category WHERE category_id = '$id'";
                  $res = mysqli_query($con,$sql);
                  if(mysqli_num_rows($res)>0){
                    while ($rows = mysqli_fetch_assoc($res)) {
                ?>
                  <!-- Form Start -->
                  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="hidden" name="id" value="<?php echo $id?>">
                          <input type="text" name="cat" class="form-control" value="<?php echo $rows['category_name'];?>" required>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" />
                  </form>
                  <!-- /Form End -->
                <?php } } } ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
