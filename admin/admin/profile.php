<?php require_once('./private/init.php'); ?>

<?php

$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());

if(!empty($admin)){
	$admin = $admin->where(["id" => Session::get_session($admin)->id])->one();
	$address = new Admin_Address();
	$address = $address->where(["admin_id"=>$admin->id])->one();

	if($address->line_2 == "null") $address->line_2 = "";
	
}else  Helper::redirect_to("login.php");

?>
<style type="text/css">
	.profileMainDiv{
		float:left;
		width:96%;
		margin:20px 0px 20px 20px;
		margin-left:20px;
		padding:30px;
		background-color: #fff;
		background-clip: border-box;
		border: 1px solid rgba(0,0,0,.125);
		border-radius: 0.25rem;
	}

	.profileSectionDiv{
		float:left;
		width:45%;
		border:0px solid red;
	}

	.profileHeaderDiv{
		float:left;
		width:95%;
		border:0px solid red;
	}

	.profileFormFieldMainDiv{
		float:left;
		width:95%;
		border:0px solid red;
	}

	.profileFieldMainDiv{
		float:left;
		width:100%;
		margin: 10px;
		border:0px solid red;
	}

	.profileFieldSubMainDiv{
		float:left;
		width:100%;
		border: 0px solid cyan;
	}

	.profileLabelDiv{
		float:left;
		width:35%;
		border: 0px solid green;
	}

	.profileFieldDiv{
		float:left;
		width:60%;
		border: 0px solid red;
	}
</style>

<?php require("common/php/php-head.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        <?php require("common/php/header.php"); ?>
        <?php require("common/php/sidebar.php"); ?>        
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">My Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">My Profile</h3>
						</div>
						<div class="main-content">
							<div class="item-wrapper two profile-page">
								<div class="item-inner">
									<div class="profileMainDiv">
										<div class="profileSectionDiv">
											<div class="profileHeaderDiv">
												<h4 class="item-header">Profile</h4>
											</div>
											<div class="profileFormFieldMainDiv">
												<form data-validation="true" action="../private/controllers/admin.php" method="post">
													<input type="hidden" name="id" value="<?php echo $admin->id; ?>">
													<?php 
														if(Session::get_session_by_key("type") == "admin_credentials"){
															if($errors) {
																Session::unset_session_by_key("type");
																echo $errors->format();
															}
														}
													?>
													<div class="profileFieldMainDiv">    
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>User Name</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="text" class="form-control" name="username" value="<?php echo $admin->username; ?>">
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="profileFieldMainDiv">  
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>E-Mail</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="text" class="form-control" name="email" value="<?php echo $admin->email; ?>">
						                                    </div>
						                                </div>
						                            </div>
													<div class="profileFieldMainDiv">  
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>Old Password</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="password" class="form-control" name="password" value="" placeholder="Enter Previous Password">
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="profileFieldMainDiv">    
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>New Password</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="password" class="form-control" name="new_pass" value="" placeholder="Enter New Password">
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="profileFieldMainDiv">    
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>Confirm Password</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="password" class="form-control" name="confirm_pass" value="" placeholder="Enter Confirm Password">
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="profileFieldMainDiv">  
						                                <div class="profileFieldSubMainDiv">
						                                   <div class="btn-wrapper"><button type="submit" class="btn btn-primary"><b>Update</b></button></div>
						                                </div>
						                            </div>
												</form>	
											</div>
										</div>
										<div class="profileSectionDiv">
											<div class="profileHeaderDiv">
												<h4 class="item-header">Address</h4>
											</div>
											<div class="profileFormFieldMainDiv">
												<form data-validation="true" action="../private/controllers/admin_address.php" method="post">
													<input type="hidden" name="id" value="<?php echo $address->id; ?>">
													<input type="hidden" name="admin_id" value="<?php echo $admin->id; ?>">
													<?php if(Session::get_session_by_key("type") == "admin_address"){
														if($message) {
															Session::unset_session_by_key("type");
													?>															
															<span style="color:green;"><?php echo $message->format(); ?></span>
													<?php		
														}
													}?>
													<div class="profileFieldMainDiv">    
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>Company Name</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="text" class="form-control" name="company_name" value="<?php echo $address->company_name; ?>">
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="profileFieldMainDiv">    
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>Address Line 1</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="text" class="form-control" name="line_1" value="<?php echo $address->line_1; ?>">
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="profileFieldMainDiv">    
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>Address Line 2</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input type="text" class="form-control" name="line_2" value="<?php echo $address->line_2; ?>">
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="profileFieldMainDiv">    
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>City</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="text" class="form-control" name="city" value="<?php echo $address->city; ?>" placeholder="City">
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="profileFieldMainDiv">    
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>Zip</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="text" class="form-control" name="zip" value="<?php echo $address->zip; ?>" placeholder="Zip">
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="profileFieldMainDiv">    
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>State</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="text" class="form-control" name="state" value="<?php echo $address->state; ?>" placeholder="State">
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="profileFieldMainDiv">    
						                                <div class="profileFieldSubMainDiv">
						                                    <div class="profileLabelDiv">
						                                    	<label>Country</label>
						                                    </div>
						                                    <div class="profileFieldDiv">
						                                    	<input data-required="true" type="text" class="form-control" name="country" value="<?php echo $address->country; ?>" placeholder="Country">
						                                    </div>
						                                </div>
						                            </div>												
						                            <div class="profileFieldMainDiv">  
								                        <div class="profileFieldSubMainDiv">
						                                   <button type="submit" class="btn btn-primary"><b>Update</b></button>
						                                </div>
						                            </div>													
												</form>	
											</div>
										</div>	
									</div>
								</div><!--item-inner-->
								</div><!--item-->
							</div><!--item-wrapper-->
						</div><!--main-content-->
					</div>
				</div>		
			</div>	
		</div>
	</section>
</div><!--main-container-->
<script src="plugins/jquery/jquery.min.js"></script>
<?php require("common/php/php-footer.php"); ?>