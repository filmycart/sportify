<?php require_once('../init.php'); ?>

<?php

if (Helper::is_post()) {
    $admin = new Admin();
    $siteConfig = new Site_Config();
    $admin->username = $_POST['userName'];
    $admin->password = $_POST['userPassword'];

    $errors = new Errors();
    if(empty($admin->username)) {
        $errors->add_error("Username can't be blank");
    }
    if(empty($admin->password)) {
        $errors->add_error("Password can't be blank");
    }

    $success = false;
    if($errors->is_empty()) {
        $admin = $admin->verify_login();

        $siteConfig = $siteConfig->ret_site_config($admin->id);

        if($admin != null) {
            $admin->password = null;
            $admin->id = (int) $admin->id;
            Session::set_session($admin);
            Session::set_session($siteConfig);
            $success = true;
        } else {
            $errors->add_error("Invalid Username/Password");
        }
    }

    if($success)  Helper::redirect_to("../../index.php");
    else {
        Session::set_session($errors);
        Session::set_session($siteConfig);
        Helper::redirect_to("../".ADMIN_FOLER_NAME."/login.php");
    }
}else Helper::redirect_to("../".ADMIN_FOLER_NAME."/login.php");

?>