<?php require_once('../init.php'); ?>
<?php

$admin = Session::get_session(new Admin());
if(empty($admin)){
    Helper::redirect_to("admin_login.php");
}else{

    $errors = new Errors();
    $message = new Message();
    $booking = new Bookings();

    if (Helper::is_get()) {
        $booking->id = Helper::get_val('id');
        $booking->admin_id = Helper::get_val('admin_id');

        if (!empty($booking->admin_id) && !empty($booking->id)) {
            if ($admin->id == $booking->admin_id) {

                $order_from_db = new Orders();
                $order_from_db = $order_from_db->where(["id" => $booking->id])->one();
                if (count($order_from_db) > 0) {

                    if ($booking->where(["id" => $booking->id])->andWhere(["admin_id" => $booking->admin_id])->delete()) {
                        $ordered_products = new Ordered_Product();
                        $ordered_products->where(["product_order" => $booking->id])->delete();

                        $message->set_message("Successfully Deleted.");

                    } else  $errors->add_error("Error Occurred While Deleting");
                } else  $errors->add_error("Invalid Category");
            } else $errors->add_error("You re only allowed to delete your own data.");
        } else  $errors->add_error("Invalid Parameters.");

        if (!$message->is_empty()) Session::set_session($message);
        else Session::set_session($errors);

        Helper::redirect_to("../../".ADMIN_FOLER_NAME."/bookings.php");
    }

}

?>