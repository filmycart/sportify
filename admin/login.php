
<?php 
	require("common/php/php-login-head.php"); 
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Sport</b>IFY</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    	<form data-validation="true" action="../private/controllers/admin_login.php" method="POST">
        <div class="input-group mb-3">
          <input type="text" name="username" id="username" class="form-control" value="<?php $admin->username; ?>" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" value="<?php $admin->email; ?>" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
		  <?php if($errors) echo $errors->format(); ?>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="forgot-password.php">Forgot Password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register</a>
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
</body>
</html>
<!--
	<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
	<script src="common/other/script.js"></script>
-->