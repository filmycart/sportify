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
        <div class="input-group mb-3" id="input-group-error">
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
          <div class="col-8">
            <div class="icheck-primary" id="input-group-error">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
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
</body>
</html>

<!-- jQuery -->
<!--         <script src="../admin/plugins/jquery/jquery.min.js"></script>
 -->        <!-- jquery-validation -->
<script src="../admin/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../admin/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
    $(document).ready(function () {
      $("form").submit(function (event) {
        $('#frmAdminUsrRegister').validate({
            rules: {
                userFullName: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                userLoginName: {
                    required: true,
                    minlength: 10,
                    maxlength: 50
                },
                userEmail: {
                    required: true,
                    minlength: 10,
                    maxlength: 50
                },
                userPassword: {
                    required: true,
                    minlength: 10,
                    maxlength: 50
                },
                userCpassword: {
                    required: true,
                    minlength: 10,
                    maxlength: 50
                },
            },
            messages: {
                userFullName: {
                    required: "Enter Full Name.",
                    minlength: "Title should be minimum of 5 chanracters.",
                    maxlength: "Title should should not be beyond 50 characters."
                },
                userLoginName: {
                    required: "Enter Login Name.",
                    minlength: "Title should be minimum of 5 chanracters.",
                    maxlength: "Title should should not be beyond 50 characters."
                },
                userEmail: {
                    required: "Enter E-Mail.",
                    minlength: "Title should be minimum of 5 chanracters.",
                    maxlength: "Title should should not be beyond 50 characters."
                },
                userPassword: {
                    required: "Enter Password.",
                    minlength: "Title should be minimum of 5 chanracters.",
                    maxlength: "Title should should not be beyond 50 characters."
                },
                userCpassword: {
                    required: "Enter Confirm Password.",
                    minlength: "Title should be minimum of 5 chanracters.",
                    maxlength: "Title should should not be beyond 50 characters."
                }                  
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('error');
                element.closest('#input-group-error').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        var userFullName = $("#userFullName").val();
        var userLoginName = $("#userLoginName").val();
        var userEmail = $("#userEmail").val();
        var userPassword = $("#userPassword").val();
        var userCpassword = $("#userCpassword").val();
        
        /*var eventStartDate = $("#eventStartDate").val();
        var eventEndDate = $("#eventEndDate").val();
        var eventVenue = $("#eventVenue").val();
        var eventCountry = $("#eventCountry").val();
        var eventCategory = $("#eventCategory").val();
        var eventSubCategory = $("#eventSubCategory").val();*/

        var formData = {
            userFullName: userFullName,
            userLoginName: userLoginName,
            userEmail: userEmail,
            userPassword: userPassword,
            userCpassword: userCpassword,

            /*
            eventStartDate: eventStartDate,
            eventEndDate: eventEndDate,
            eventVenue: eventVenue,
            eventCountry: eventCountry,
            eventCategory: eventCategory,
            eventSubCategory: eventSubCategory,*/
        };

        $.ajax({
            url: "../private/controllers/admin_register_src.php",
            cache: false,
            type: "POST",
            datatype:"JSON",
            data: formData,
            success: function(html) {
                //$("#registerAdminUserRespDiv").append(html);
                //$("#eventSucResponseDiv").append(html);
                setTimeout(function() {
                    window.location.replace("index.php");
                }, 1000);
            }
        });
        event.preventDefault();
      });
    }); 

    /*jQuery.noConflict();
    (function( $ ) {
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    var eventId = $("#eventId").val();
                    var eventAction = $("#eventAction").val();
                    var eventTitle = $("#eventTitle").val();
                    var eventState = $("#eventState").val();
                    var eventCity = $("#eventCity").val();
                    var eventStartDate = $("#eventStartDate").val();
                    var eventEndDate = $("#eventEndDate").val();
                    var eventVenue = $("#eventVenue").val();
                    var eventCountry = $("#eventCountry").val();
                    var eventCategory = $("#eventCategory").val();
                    var eventSubCategory = $("#eventSubCategory").val();

                    var formData = {
                        eventId: eventId,
                        eventAction: eventAction,
                        eventTitle: eventTitle,
                        eventState: eventState,
                        eventCity: eventCity,
                        eventStartDate: eventStartDate,
                        eventEndDate: eventEndDate,
                        eventVenue: eventVenue,
                        eventCountry: eventCountry,
                        eventCategory: eventCategory,
                        eventSubCategory: eventSubCategory,
                    };

                    $.ajax({
                        url: "../private/controllers/event.php",
                        cache: false,
                        type: "POST",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            $("#eventSucResponseDiv").append(html);
                            setTimeout(function() {
                                window.location.replace("events.php");
                            }, 2000);
                        }
                    });
                }
            });

            $('#addEvent').validate({
                rules: {
                    eventTitle: {
                        required: true,
                        minlength: 5,
                        maxlength: 50
                    },
                    eventVenue: {
                        required: true,
                        minlength: 10,
                        maxlength: 200
                    },
                    eventStartDate: {
                        required: true
                    },
                    eventEndDate: {
                        required: true
                    }
                },
                messages: {
                    eventTitle: {
                        required: "Enter Title.",
                        minlength: "Title should be minimum of 5 chanracters.",
                        maxlength: "Title should should not be beyond 50 characters."
                    },
                    eventVenue: {
                        required: "Enter Venue.",
                        minlength: "Title should be minimum of 5 chanracters.",
                        maxlength: "Title should should not be beyond 200 characters."
                    },
                    eventStartDate: {
                        required: "Enter Start Date and Time."
                    },
                    eventEndDate: {
                        required: "Enter End Date and Time."
                    }                   
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    })(jQuery);*/
</script>    