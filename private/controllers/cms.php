<?php require_once('../init.php'); ?>
<?php

$admin = Session::get_session(new Admin());
if(empty($admin)){
    Helper::redirect_to("admin_login.php");
}else{
    $errors = new Errors();
    $message = new Message();
    $cms = new Cms();

    if (Helper::is_post()) {
        $cms->created_by = trim($_POST['created_by']);
        
        if(empty($_POST['id'])){
            if(!empty($_POST['parent_id'])) {
                $cms->parent_id = trim($_POST['parent_id']);
            }
            else {
                $cms->parent_id = -1;   
            }	

            $cms->name = trim($_POST['name']);
            $cms->title = trim($_POST['title']);
            $cms->description = trim($_POST['description']);
            $cms->display_order = trim($_POST['display_order']);
            $cms->status = (isset($_POST['status'])) ? 1 : 2;

            $cms->validate_except(["id","name", "title", "description"]);
            $errors = $cms->get_errors();
			
            if($errors->is_empty()){
                if($errors->is_empty()){
					if($cms->save()){
						$has_error_creation = false;
                        if(!$has_error_creation) $message->set_message("Cms Created Successfully");
                    }
                }
            }

            if(!$message->is_empty()){
                Session::set_session($message);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/cms.php");
            }else if(!$errors->is_empty()){
                Session::set_session($errors);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/cms-form.php");
            }

        }else if(!empty($_POST['id'])){
            $cms->id = trim($_POST['id']);
			//$cms->parent_id = trim($_POST['parent_id']);

            if(!empty($_POST['parent_id'])) {
                $cms->parent_id = trim($_POST['parent_id']);
            }
            else {
                $cms->parent_id = -1;   
            }

			$cms->name = trim($_POST['name']);
            $cms->title = trim($_POST['title']);
			$cms->description = trim($_POST['description']);
			$cms->display_order = trim($_POST['display_order']);
			$cms->status = (isset($_POST['status'])) ? 1 : 2;

            $cms->validate_except(["id", "name", "title", "description"]);
            $errors = $cms->get_errors();
		
            if($errors->is_empty()){
				if($cms->where(["id"=>$cms->id])->andWhere(["created_by" => $cms->created_by])->update()){
                    $has_error_updating = false;
					if(!$has_error_updating){
						$message->set_message("Cms Updated Successfully");
					}
					else{
						$errors->add_error($cms->name . " failed to update.");
					}
				}                
            }

            if(!$message->is_empty()){
                Session::set_session($message);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/cms.php");
            }else if(!$errors->is_empty()){
                Session::set_session($errors);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/cms-form.php?id=" . $cms->id);
            }
        }
    }else if (Helper::is_get()) {		
       //$cms->id = Helper::get_val('id');	
		$cms_from_db = new Cms();
        $cms_from_db = $cms_from_db->where(["id" => Helper::get_val('id')])->one();

        if(!empty($cms_from_db->created_by) && !empty($cms_from_db->id)){
            if($admin->id == $cms_from_db->created_by){
                /*$cms_from_db = new Cms();
                $cms_from_db = $cms_from_db->where(["id" => $cms->id])->one();*/
                if(count(array($cms_from_db)) > 0){
                    if($cms_from_db->where(["id" => $cms_from_db->id])->andWhere(["created_by" => $cms_from_db->created_by])->delete()){
                        $message->set_message("Successfully Deleted.");
                    }else  $errors->add_error("Error Occurred While Deleting");
                }else  $errors->add_error("Invalid Cms");
            }else $errors->add_error("You re only allowed to delete your own data.");
        }else  $errors->add_error("Invalid Parameters.");

        if(!$message->is_empty()) Session::set_session($message);
        else Session::set_session($errors);

        Helper::redirect_to("../../".ADMIN_FOLER_NAME."/cms.php");
    }
}

?>