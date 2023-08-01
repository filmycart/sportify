<?php
	/*$s_config = new Site_Config();
	if(!empty($admin->id)){

	    $s_config = $s_config->where(["admin_id" => $admin->id])->one();
	}else{
	    $s_config->title = "Sportify";
	    $s_config->tag_line = "A Simple Website";
	    $s_config->favicon_image_name = "";
	}*/
?>
<?php 
  require_once('../private/init.php'); 

  $errors = Session::get_temp_session(new Errors());
  $admin = Session::get_session(new Admin());

  if(!empty($admin)){
    Helper::redirect_to("index.php");
      $admin = $admin->where(["id" => $admin->id])->one();
  }else $admin = new Admin();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--   <title><?=($s_config->title)?$s_config->title:''?> - <?=($s_config->tag_line)?$s_config->tag_line:''?></title>
  -->
  <title>Login</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>