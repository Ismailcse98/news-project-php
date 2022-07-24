<?php 
session_start();
include "config.php";
if(isset($_SESSION['username'])){
    header("Location:post.php");
}
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                        <?php 
                        if(isset($_POST['login'])){
                            $username = mysqli_real_escape_string($con,$_POST['username']);
                            $password = mysqli_real_escape_string($con,md5($_POST['password']));
                            $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
                            $res = mysqli_query($con,$sql);
                            if(mysqli_num_rows($res)>0){
                                session_start();
                                while ($data = mysqli_fetch_assoc($res)) {
                                    $_SESSION['user_id'] = $data['user_id'];
                                    $_SESSION['username'] = $data['username'];
                                    $_SESSION['user_role'] = $data['role'];
                                    header('Location:post.php');
                                }
                            }else{
                                echo "Username and Password are not matched";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
