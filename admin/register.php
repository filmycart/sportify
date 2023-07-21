<?php 
  require("common/php/php-register-head.php"); 
?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Sport</b>IFY</a>
  </div>
  <div class="card">
    <div id="registerAdminUserRespDiv"></div>
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register</p>
      <form data-validation="true" action="../private/controllers/admin_register.php" name="frmAdminUsrRegister" id="frmAdminUsrRegister" method="POST">  
        <div class="input-group mb-3">
          <select id="userType" name="userType" class="form-control">
              <option>Admin</option>
              <option>Supervisor</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-circle"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3" id="input-group-error">
          <input type="text" id="userFullName" name="userFullName" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3" id="input-group-error">
          <input type="text" id="userLoginName" name="userLoginName" class="form-control" placeholder="User Login Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3" id="input-group-error">
          <input type="text" id="userEmail" name="userEmail" class="form-control" placeholder="User E-Mail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3" id="input-group-error">
          <input type="password" id="userPassword" name="userPassword" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3" id="input-group-error">
          <input type="password" id="userCpassword" name="userCpassword" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="icheck-primary" id="input-group-error">
            <div class="form-group mb-0">
              <div class="custom-control custom-checkbox">
                &nbsp;&nbsp;<input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">Terms</a>.</label>
              </div>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <?php 
            /*if($errors) {
              echo $errors->format();
            }*/
          ?>
          <!-- /.col -->
        </div>
      </form>
      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
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
      $("form[name='frmAdminUsrRegister']").validate({
            rules: {
                userFullName: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                userLoginName: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                userEmail: {
                    required: true,
                    minlength: 5,
                    maxlength: 50,
                    email: true
                },
                userPassword: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                userCpassword: {
                    required: true,
                    minlength: 5,
                    maxlength: 50,
                    equalTo: "#userPassword"
                },
                terms: {
                  required: true
                },
            },
            messages: {
                userFullName: {
                    required: "Please Enter Admin User Full Name.",
                    minlength: "Title should be minimum of 5 characters.",
                    maxlength: "Title should should not be beyond 50 characters."
                },
                userLoginName: {
                    required: "Please Enter Admin User Login Name.",
                    minlength: "Title should be minimum of 5 characters.",
                    maxlength: "Title should should not be beyond 50 characters."
                },
                userEmail: {
                    required: "Please Enter Admin User E-Mail Address.",
                    minlength: "Title should be minimum of 5 characters.",
                    maxlength: "Title should should not be beyond 50 characters.",
                    email: "Please enter a valid email address."
                },
                userPassword: {
                    required: "Please Enter Admin User Password.",
                    minlength: "Title should be minimum of 5 characters.",
                    maxlength: "Title should should not be beyond 50 characters."
                },
                userCpassword: {
                    required: "Please Enter Admin User Confirm Password.",
                    minlength: "Title should be minimum of 5 characters.",
                    maxlength: "Title should should not be beyond 50 characters.",
                    equalTo: "Please enter the same password as above."
                },
                terms: {
                  required: "Please accept our terms"  
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
