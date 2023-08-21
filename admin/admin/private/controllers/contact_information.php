<?php require_once('../init.php'); ?>

<?php
	require_once('../models/lib/Upload.php');
	if (Helper::is_post()) {
		$errors = new Errors();
		$message = new Message();
		$contact_information = new Contact_Information();

		$contact_information->id = $_POST['id'];
		$contact_information->admin_id = $_POST['admin_id'];

		$type = [];
		//if(!isset($_POST['firebase_auth'])){
			$type["type"]= "contact_information";
			Session::set_session($type);
		
			$contact_information->address = $_POST['address'];
			$contact_information->phone_number = $_POST['phone_number'];
			$contact_information->email = $_POST['email'];	

			$contact_information->validate_except(["image_name", "firebase_auth", "image_resolution", "group_by"]);
			$errors = $contact_information->get_errors();

			if(!$message->is_empty()) Session::set_session($message);
			else Session::set_session($errors);

			Helper::redirect_to("../../".ADMIN_FOLER_NAME."/site-config.php");

		//}else if(isset($_POST['firebase_auth'])){

			/*$site_config->firebase_auth = $_POST['firebase_auth'];
			$site_config->validate_except(["title", "tag_line", "image_name", "image_resolution", "group_by"]);
			$errors = $site_config->get_errors();

			$type["type"]= "firebase_auth";
			Session::set_session($type);

			if($errors->is_empty()){
				$new_site_config = clone $site_config;
				$new_site_config->id = null;
				$new_site_config->admin_id = null;

				if($new_site_config->where(["id"  => $site_config->id])->andWhere(["admin_id" => $site_config->admin_id])->update()){
					$message->set_message("Firebase Auth Updated");
				}else $errors->add_error("Error occurred while updating.");
			}

			if(!$message->is_empty()) Session::set_session($message);
			else Session::set_session($errors);
			
			Helper::redirect_to("../../".ADMIN_FOLER_NAME."/push-notifications.php");*/
		//}
	}
?>