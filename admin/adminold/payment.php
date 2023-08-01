<?php require_once('../private/init.php'); ?>

<?php

$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());

if (!empty($admin)) {
    $pay = new Payment();
    $pay = $pay->where(["admin_id" => $admin->id])->one();

} else Helper::redirect_to("login.php");


?>

<?php require("common/php/php-head.php"); ?>

    <body>

<?php require("common/php/header.php"); ?>

    <div class="main-container">

        <?php require("common/php/sidebar.php"); ?>

        <div class="main-content">
            <div class="item-wrapper three">

                <div class="item">

                    <?php if (Session::get_session_by_key("payment_type") == "braintree") {
                        if ($message) echo $message->format();
                    } ?>

                    <form data-validation="true" action="../private/controllers/payment.php" method="post">

                        <div class="item-inner">

                            <div class="item-header">
                                <h5 class="dplay-inl-b">Braintree Configuration</h5>

                                <h5 class="float-r oflow-hidden">
                                    <label class="status switch">
                                        <input type="checkbox" name="type"
                                            <?php if ($pay->type == 1) echo "checked"; ?>/>
                                        <span class="slider round">
                                        <b class="active">Active</b>
                                        <b class="inactive">Inactive</b>
                                    </span>
                                    </label>
                                    <span class="toggle-title"></span>
                                </h5>
                            </div><!--item-header-->


                            <div class="item-content">

                                <input type="hidden" name="id" value="<?php echo $pay->id; ?>"/>
                                <input type="hidden" name="admin_id" value="<?php echo $pay->admin_id; ?>"/>

                                <label>Environment</label>
                                <input type="text" data-required="true" placeholder="Environment" name="environment"
                                       value="<?php echo $pay->environment; ?>"/>

                                <label>Merchant ID</label>
                                <input type="text" data-required="true" placeholder="Merchant ID" name="merchant_id"
                                       value="<?php echo $pay->merchant_id; ?>"/>

                                <label>Public Key</label>
                                <input type="text" data-required="true" placeholder="Public Key" name="public_key"
                                       value="<?php echo $pay->public_key; ?>"/>

                                <label>Private Key</label>
                                <input type="text" data-required="true" placeholder="Private Key" name="private_key"
                                       value="<?php echo $pay->private_key; ?>"/>

                                <div class="btn-wrapper">
                                    <button type="submit" class="demo-disable c-btn mb-10"><b>Update</b></button>
                                </div>

                                <?php if (Session::get_session_by_key("payment_type") == "braintree") {
                                    Session::unset_session_by_key("payment_type");
                                    if ($errors) echo $errors->format();
                                } ?>


                            </div><!--item-content-->

                        </div><!--item-inner-->
                    </form>
                </div><!--item-->


                <div class="item">

                    <?php if (Session::get_session_by_key("payment_type") == "razorpay") {
                        if ($message) echo $message->format();
                    } ?>
                    <form data-validation="true" action="../private/controllers/payment.php" method="post">
                        <div class="item-inner">

                            <div class="item-header">
                                <h5 class="dplay-inl-b">Razorpay Configuration</h5>

                                <h5 class="float-r oflow-hidden">
                                    <label class="status switch">
                                        <input type="checkbox" name="type"
                                            <?php if ($pay->type == 2) echo "checked"; ?>/>
                                        <span class="slider round">
                                        <b class="active">Active</b>
                                        <b class="inactive">Inactive</b>
                                    </span>
                                    </label>
                                    <span class="toggle-title"></span>
                                </h5>
                            </div><!--item-header-->


                            <div class="item-content">

                                <input type="hidden" name="id" value="<?php echo $pay->id; ?>"/>
                                <input type="hidden" name="admin_id" value="<?php echo $pay->admin_id; ?>"/>

                                <label>Razorpay Key</label>
                                <input type="text" data-required="true" placeholder="Razorpay Key" name="razorpay_key"
                                       value="<?php echo $pay->razorpay_key; ?>"/>

                                <label>Razorpay Secret</label>
                                <input type="text" data-required="true" placeholder="Razorpay Secret"
                                       name="razorpay_secret" value="<?php echo $pay->razorpay_secret; ?>"/>

                                <div class="btn-wrapper">
                                    <button type="submit" class="demo-disable c-btn mb-10"><b>Update</b></button>
                                </div>

                                <?php if (Session::get_session_by_key("payment_type") == "razorpay") {
                                    Session::unset_session_by_key("payment_type");
                                    if ($errors) echo $errors->format();
                                } ?>


                            </div><!--item-content-->

                        </div><!--item-inner-->

                    </form>
                </div><!--item-->


            </div><!--item-wrapper-->
        </div><!--main-content-->
    </div><!--main-container-->

<?php echo "<script>maxUploadedFile = '" . MAX_IMAGE_SIZE . "'</script>"; ?>

<?php require("common/php/php-footer.php"); ?>