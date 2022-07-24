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
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">

                  <table class="content-table">
                      <thead>
                          <th>DB ID</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                <?php 
                  $limit = 3;
                  if(isset($_GET['page'])){
                    $page_number = $_GET['page'];
                  }else{
                    $page_number = 1;
                  }
                  $offset = ($page_number-1) * $limit;
                  $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT $offset,$limit";
                  $res = mysqli_query($con,$sql);
                  while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                    <tr>
                      <td><?php echo $data['user_id'];?></td>
                      <td><?php echo $data['first_name']." ".$data['last_name'];?></td>
                      <td><?php echo $data['username'];?></td>
                      <td><?php
                      if($data['role'] == 1){
                        echo "Admin";
                      }else{
                        echo "Moderator";
                      }
                      ?></td>
                      <td><a href="update_user.php?id=<?php echo $data['user_id'];?>"><i class="fa fa-edit"></i></a></td>
                      <td>
                        <a onclick="return confirm('Are your sure??')" href="delete_user.php?id=<?php echo $data['user_id'];?>"><i class="fa fa-trash"></i></a></td>
                    </tr>
                <?php } ?>
                      </tbody>

                  </table>

                  <?php 
                    $dataSql ="SELECT * FROM user";
                    $dataRes = mysqli_query($con,$dataSql);
                    $dataCount = mysqli_num_rows($dataRes);
                    if($dataCount>0){
                      $totalPage = ceil($dataCount/$limit);
                      echo "<ul class='pagination admin-pagination'>";
                      if($page_number >1){
                        echo '<li><a href="users.php?page='.($totalPage - 1).'">prev</a></li>';
                      }
                      for ($i=1; $i <=$totalPage ; $i++) { 
                        if($page_number == $i){
                            $active="active";
                        }else{
                            $active="";
                        }
                        echo "<li class=".$active."><a href='users.php?page=$i'>".$i."</a></li>";
                      }
                      if($totalPage > $page_number){
                        echo '<li><a href="users.php?page='.($totalPage + 1).'">next</a></li>';
                      }
                      echo "</ul>";
                    }
                  ?>
                      
                  






              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
