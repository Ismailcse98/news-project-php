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
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
      <?php 
      if(isset($_POST['add'])){
        $fname = mysqli_real_escape_string($con,$_POST['fname']);
        $lname = mysqli_real_escape_string($con,$_POST['lname']);
        $user = mysqli_real_escape_string($con,$_POST['user']);
        $password = mysqli_real_escape_string($con,md5($_POST['password']));
        $role = mysqli_real_escape_string($con,$_POST['role']);

        $checkSql = "SELECT username FROM user WHERE username = '$user'";
        $checkResult = mysqli_query($con,$checkSql);
        $count = mysqli_num_rows($checkResult);
        if($count>0){
          echo "User name is already exits";
        }else{
          $sql = "INSERT INTO user (first_name,last_name,username,password,role)VALUES('$fname','$lname','$user','$password','$role')";
          $res = mysqli_query($con, $sql);
          if($res){
            header("Location:users.php");
          }
        }
      }
      ?>
                  <!-- Form Start -->
                  <form  action="<?php echo $_SERVER['PHP_SELF']?>" method ="POST">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Moderator</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="add" class="btn btn-primary btn-block" value="Add" />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
