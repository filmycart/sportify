<?php require_once('../init.php'); ?>
<?php

$admin = Session::get_session(new Admin());
if(empty($admin)){
    Helper::redirect_to("admin_login.php");
}else{

    $errors = new Errors();
    $message = new Message();
    $sub_category = new Sub_Category();

    if (Helper::is_post()) {
        $sub_category->admin_id = $_POST['admin_id'];

        if(empty($_POST['id'])){
            $sub_category->title = $_POST['title'];
            $sub_category->category_id = $_POST['category_id'];
            $sub_category->status = (isset($_POST['status'])) ? 1 : 2;

            $sub_category->image_name = $_FILES["image_name"]["name"];

            $sub_category->validate_except(["id", "image_resolution"]);
            $errors = $sub_category->get_errors();

            if($errors->is_empty()){
                if(!empty($_FILES["image_name"]["name"])){
                    $upload = new Upload($_FILES["image_name"]);
                    $upload->set_max_size(MAX_IMAGE_SIZE);
                    if($upload->upload()) {
                        $sub_category->image_name = $upload->get_file_name();
                        $sub_category->image_resolution = $upload->resolution;
                    }
                    $errors = $upload->get_errors();
                }

                if($errors->is_empty()){
                    $id = $sub_category->save();
                    $has_error_creation = false;
                    if($id) $message->set_message("Sub Category Created Successfully");

                }
            }

            if(!$message->is_empty()){
                Session::set_session($message);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/sub-categories.php");
            }else if(!$errors->is_empty()){
                Session::set_session($errors);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/sub-category-form.php");
            }

        }else if(!empty($_POST['id'])){
            $sub_category->id = $_POST['id'];
            $sub_category->category_id = $_POST['category_id'];
            $sub_category->title = $_POST['title'];
            $sub_category->status = (isset($_POST['status'])) ? 1 : 2;
            $sub_category->image_name = $_POST['prev_image'];


            $sub_category->validate_except(["image_name", "image_resolution"]);
            $errors = $sub_category->get_errors();

            if($errors->is_empty()){

                if(!empty($_FILES["image_name"]["name"])){
                    $upload = new Upload($_FILES["image_name"]);
                    $upload->set_max_size(MAX_IMAGE_SIZE);
                    if($upload->upload()){
                        $upload->delete($sub_category->image_name);
                        $sub_category->image_name = $upload->get_file_name();
                        $sub_category->image_resolution = $upload->resolution;
                    }
                    $errors = $upload->get_errors();
                }

                if($errors->is_empty()){
                    if($sub_category->where(["id"=>$sub_category->id])->andWhere(["admin_id" => $sub_category->admin_id])->update()){
                         $message->set_message("Sub Category Updated Successfully");
                    }
                }
            }

            if(!$message->is_empty()){
                Session::set_session($message);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/sub-categories.php");
            }else if(!$errors->is_empty()){
                Session::set_session($errors);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/sub-category-form.php?id=" . $sub_category->id);
            }
        }
    }else if (Helper::is_get()) {
        $sub_category->id = Helper::get_val('id');
        $sub_category->admin_id = Helper::get_val('admin_id');

        if(!empty($sub_category->admin_id) && !empty($sub_category->id)){
            if($admin->id == $sub_category->admin_id){

                $sub_category_from_db = new Sub_Category();
                $sub_category_from_db = $sub_category_from_db->where(["id" => $sub_category->id])->one();
                if(count($sub_category_from_db) > 0){
                    $image = $sub_category_from_db->image_name;

                    if($sub_category->where(["id" => $sub_category->id])->andWhere(["admin_id" => $sub_category->admin_id])->delete()){
                        Upload::delete($image);

                        $products_of_cat = new Product();
                        $products_of_cat = $products_of_cat->where(["sub_category_id"=>$sub_category->id])->all();
                        
                        foreach ($products_of_cat as $p_item){
                            Upload::delete($p_item->image_name);

                            $item_images = new Item_Image();
                            $item_images = $item_images->where(["item_id" => $p_item->id])->all();

                            foreach ($item_images as $p_image_item){
                                Upload::delete($p_image_item->image_name);
                            }

                            $new_item_image = new Item_Image();
                            $new_item_image->where(["item_id" => $p_item->id])->delete();
                            
                            $inventory = new Inventory();
                            $inventory = $inventory->where(["product"=>$p_item->id])->delete();

                            $new_products_of_cat = new Product();
                            $new_products_of_cat->where(["id"=>$p_item->id])->delete();
                        }

                        $message->set_message("Successfully Deleted.");

                    }else  $errors->add_error("Error Occurred While Deleting");
                }else  $errors->add_error("Invalid Sub Category");
            }else $errors->add_error("You re only allowed to delete your own data.");
        }else  $errors->add_error("Invalid Parameters.");

        if(!$message->is_empty()) Session::set_session($message);
        else Session::set_session($errors);

        Helper::redirect_to("../../".ADMIN_FOLER_NAME."/sub-categories.php");
    }
}

?>