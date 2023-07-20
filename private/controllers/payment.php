<?php require_once('../init.php'); ?>

<?php

if (Helper::is_post()) {
    $errors = new Errors();
    $message = new Message();
    $payment = new Payment();

    $payment->id = $_POST['id'];
    $payment->admin_id = $_POST['admin_id'];


    $type = [];
    if (isset($_POST['environment'])) {
        $type["payment_type"] = "braintree";
        Session::set_session($type);

        $payment->environment = $_POST['environment'];
        $payment->merchant_id = $_POST['merchant_id'];
        $payment->public_key = $_POST['public_key'];
        $payment->private_key = $_POST['private_key'];
        $payment->type = (isset($_POST['type'])) ? 1 : 2;

        $payment->validate_with(["type", "environment", "merchant_id", "public_key", "private_key"]);
        $errors = $payment->get_errors();

        if ($errors->is_empty()) {

            $new_payment = clone $payment;
            $new_payment->id = null;
            if ($new_payment->where(["id" => $payment->id])->update()) {
                $message->set_message("Braintree Updated");
            }
        }

        if (!$message->is_empty()) Session::set_session($message);
        else Session::set_session($errors);

        Helper::redirect_to("../../".ADMIN_FOLER_NAME."/payment.php");

    } else if (isset($_POST['razorpay_key'])) {

        $type["payment_type"] = "razorpay";
        Session::set_session($type);


        $payment->razorpay_key = $_POST['razorpay_key'];
        $payment->razorpay_secret = $_POST['razorpay_secret'];
        $payment->type = (isset($_POST['type'])) ? 2 : 1;


        $payment->validate_with(["razorpay_key", "razorpay_secret", "type"]);
        $errors = $payment->get_errors();

        if ($errors->is_empty()) {

            $new_payment = clone $payment;
            $new_payment->id = null;
            if ($new_payment->where(["id" => $payment->id])->update()) {
                $message->set_message("Razorpay Updated");
            }
        }

        if (!$message->is_empty()) Session::set_session($message);
        else Session::set_session($errors);

        Helper::redirect_to("../../".ADMIN_FOLER_NAME."/payment.php");


    }
}

?>