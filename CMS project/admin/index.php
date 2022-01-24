<?php
ob_start();
session_start();
include "inc/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">

<!-- Start Php Log in and Log out Operation -->

<?php
  
  if(isset($_POST['login'])){

    $email    = mysqli_real_escape_string($db, $_POST['email']);
    $pass     = mysqli_real_escape_string($db, $_POST['password']);

    $hassedPass = sha1($pass);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password='$hassedPass'";

    $userData = mysqli_query($db, $sql);

    $countUser = mysqli_num_rows($userData);

    if( $countUser == 0){
      $_SESSION['msg'] = "Your login information is wrong";
    }
    else{

      while($row = mysqli_fetch_assoc($userData)){
        $_SESSION['id']       = $row['id'];
        $_SESSION['name']     = $row['name'];
        $_SESSION['email']    = $row['email'];
        $password             = $row['password'];
        $_SESSION['role']     = $row['role'];
        $status               = $row['status'];
        $_SESSION['msg']      = "Your login information in wrong";

        if($status == 1){

          if( $email == $_SESSION['email']  && $hassedPass == $password){
            header("Location: dashboard.php");
          }
    
          else if($_SESSION['email'] != $email || $password != $hassedPass){
            // $_SESSION['msg'] = "Your login information is wrong";
            header("Location: index.php");
          }
    
          else{
            // $_SESSION['msg'] = "Your login information is wrong";
            header ("Location: index.php");
          }

        }
        else if($status == 0){
          // $_SESSION['msg'] = "Your login information is wrong";
          echo $_SESSION['msg'];
        }
      }
    }
  }
  
  ?>

<!-- End Php Log in Log out Operation -->

<div class="login-box">
  <div class="login-logo">
    <a href=""><b>To Do</b>Application</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" name="login" value="Sign In" class="btn btn-primary btn-block">
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- Start Log in information wrong part php -->

      <?php
       if(!empty ($_SESSION['msg'])){

        ?>

        <div class="alert alert-danger">
          <?php echo $_SESSION['msg']; ?>
        </div>

      <?php  
        unset($_SESSION['msg']);
        }
       ?>

      <!-- End Log in information wrong part php -->

      <div class="social-auth-links text-center mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new employee</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<?php
ob_end_flush();
?>

</body>
</html>
