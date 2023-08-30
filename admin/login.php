
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
    	<form data-validation="true" action="./private/controllers/admin_login.php" name="frmAdminUsrLogin" id="frmAdminUsrLogin" method="POST">	
        <div class="input-group mb-3"  id="input-group-error">
          <input type="text" name="userName" id="userName" class="form-control" placeholder="User Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3" id="input-group-error">
          <input type="password" name="userPassword" id="userPassword" class="form-control" placeholder="Password">
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
		  <?php 
		  	if($errors) echo $errors->format(); 
		  ?>
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
<script src="../admin/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../admin/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
    $(document).ready(function () {
      $("form[name='frmAdminUsrLogin']").validate({
            rules: {
                userName: {
                    required: true/*,
                    minlength: 5,
                    maxlength: 50,
                    email:true*/
                },
                userPassword: {
                    required: true/*,
                    minlength: 10,
                    maxlength: 50*/
                }
            },
            messages: {
                userName: {
                    required: "Please Enter Admin User Name."/*,
                    minlength: "Title should be minimum of 5 characters.",
                    maxlength: "Title should should not be beyond 50 characters.",
                    email: "Please enter a valid email address."*/
                },
                userPassword: {
                    required: "Please Enter Admin User Password."/*,
                    minlength: "Title should be minimum of 5 characters.",
                    maxlength: "Title should should not be beyond 50 characters."*/
                }           
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('#input-group-error').append(error);
            },
            highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
              form.submit();
            }
        });
      });
  </script>
</body>
</html>
<!--
	<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
	<script src="common/other/script.js"></script>
-->