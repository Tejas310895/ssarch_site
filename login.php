<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SSARCHINDIA</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="template/vendors/feather/feather.css">
  <link rel="stylesheet" href="template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="template/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="template/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="template/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="template/images/m_logo.jpg" alt="logo">
              </div>
              <h4>Good Morning</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form action="" method="post" class="pt-3">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="username" placeholder="username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="password">
                </div>
                <div class="mt-3">
                  <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="login" type="submit" value="Sign In">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-right">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="template/js/off-canvas.js"></script>
  <script src="template/js/hoverable-collapse.js"></script>
  <script src="template/js/template.js"></script>
  <script src="template/js/settings.js"></script>
  <script src="template/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>

<?php

if (isset($_POST['login'])) {
  require_once("includes/db.php");
  $user_n = $_POST['username'];
  $user_p = $_POST['password'];

  $sql = "SELECT * FROM users WHERE user_email='$user_n'";
  $results = $con->query($sql);
  if ($results->num_rows > 0) {
    $u_data = $results->fetch_assoc();
    if (password_verify($user_p, $u_data['user_pass'])) {
      if (in_array($u_data['user_role'], ['site_incharge', 'site_staff'])) {
        session_start();
        $_SESSION['user'] = $u_data['user_id'];
        echo "<script>alert('Login Successfull')</script>";
        echo "<script>window.open('index.php?dashboard','_self')</script>";
      } else {
        echo "<script>alert('Access denied for your role')</script>";
        echo "<script>window.open('login.php','_self')</script>";
      }
    } else {
      echo "<script>alert('Invalid Password')</script>";
      echo "<script>window.open('login.php','_self')</script>";
    }
  } else {
    echo "<script>alert('New to the site! Register first')</script>";
    echo "<script>window.open('login.php','_self')</script>";
  }
}

?>