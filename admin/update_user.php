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
                  <h1 class="admin-heading">Update User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
      <?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $select = "SELECT * FROM user WHERE user_id = '$id'";
        $selectResult = mysqli_query($con, $select);
        $findCount = mysqli_num_rows($selectResult);
        if($findCount>0){
          $data = mysqli_fetch_assoc($selectResult);
          
        }
      }

      if(isset($_POST['update'])){
        $edit_id = $_POST['id'];
        $fname = mysqli_real_escape_string($con,$_POST['fname']);
        $lname = mysqli_real_escape_string($con,$_POST['lname']);
        $user = mysqli_real_escape_string($con,$_POST['user']);
        $role = mysqli_real_escape_string($con,$_POST['role']);

          $updateSql = "UPDATE user SET first_name='$fname',last_name='$lname',username='$user',role='$role' WHERE user_id='$edit_id'";
          $res = mysqli_query($con, $updateSql);
          if($res){
            header("Location:users.php");
          }
      }
      ?>
                  <!-- Form Start -->
                  <form  action="<?php echo $_SERVER['PHP_SELF']?>" method ="POST">
                    <input type="hidden" name="id" value="<?php echo $data['user_id'];?>">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" value="<?php echo $data['first_name'];?>" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" value="<?php echo $data['last_name'];?>" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" value="<?php echo $data['username'];?>" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                            <?php 
                            if($data['role']==0){
                              echo "<option value='0' selected>Moderator</option>";
                               echo "<option value='1'>Admin</option>";
                            }else{
                              echo "<option value='1' selected>Admin</option>";
                              echo "<option value='0'>Moderator</option>";
                            }

                            ?>
                          </select>
                      </div>
                      <input type="submit"  name="update" class="btn btn-primary btn-block" value="Update" />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
