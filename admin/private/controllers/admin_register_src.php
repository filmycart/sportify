<?php require_once('../init.php'); ?>

<?php

/*print"<pre>";
print_r($_POST);
exit;*/

if (Helper::is_post()) {
    $admin = new Admin();
    $s_config = new Site_Config();
    $adminSession = new Admin();
    $admin->displayname = $_POST['userFullName'];
    $admin->email = $_POST['userEmail'];
    $admin->username = $_POST['userLoginName'];
    $admin->password = $_POST['userPassword'];

    $errors = new Errors();
    if(empty($admin->displayname)){
        $errors->add_error("Full Name can't be blank");
    }

    if(empty($admin->email)){
        $errors->add_error("Email can't be blank");
    }

    if(empty($admin->username)){
        $errors->add_error("Username can't be blank");
    }

    if(empty($admin->password)){
        $errors->add_error("Password can't be blank");
    }

    $success = false;
    $id = "";
    $regAdminUser = $ret_site_config = array();
    if($errors->is_empty()) {
        $regAdminUser = $admin->verify_register();
        if($regAdminUser != null) {
            $errors->add_error("Username Password combination already exist.");
        }
    } 

    if($errors->is_empty()) {
        $adminSession->id = (int) $id;
        $adminSession->password = password_hash($admin->password, PASSWORD_BCRYPT);
        $adminSession->email = $admin->email;
        $adminSession->username = $admin->username;

        $site_config_frm_db = $s_config->where(["1" => 1])->one();

        if(!empty($site_config_frm_db)) {
            $s_config->admin_id = $id;
            $s_config->title = $site_config_frm_db->title;
            $s_config->tag_line = $site_config_frm_db->tag_line;
            $s_config->image_name = $site_config_frm_db->image_name;
            $s_config->favicon_image_name = $site_config_frm_db->favicon_image_name;
            $s_config->loading_image_name = $site_config_frm_db->loading_image_name;
            $s_config->address = $site_config_frm_db->address;
            $s_config->phone_number = $site_config_frm_db->phone_number;
            $s_config->email = $site_config_frm_db->email;
            $s_config->save();
        }

        Session::set_session($adminSession);
        $success = true;
    }

    if($success)  Helper::redirect_to("../../".ADMIN_FOLER_NAME."/index.php");
    else{
        Session::set_session($errors);
        Helper::redirect_to("../../".ADMIN_FOLER_NAME."/register.php");
    }
}else Helper::redirect_to("../../".ADMIN_FOLER_NAME."/register.php");

?>