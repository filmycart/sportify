<?php require_once('../private/init.php'); ?>

<?php

$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());
$deletable_image_ids = "";
$inventory_status = "active";
$single_inventory = 0;

if(!empty($admin)){
    $cms = new Cms();

    $cms->created_by = $admin->id;
    $cms->status = 1;

    $panel_setting = new Setting();
    $panel_setting = $panel_setting->where(["admin_id"=> $admin->id])->one();

    if(Helper::is_get() && isset($_GET["id"])){
        $cms->id = $_GET["id"];
        $cms = $cms->where(["id" => $cms->id])->andwhere(["created_by" => $admin->id])->one();
    }
}else Helper::redirect_to("login.php");
	$parent_cms_array = new Cms();
	$parent_cms_array = $parent_cms_array->where(["parent_id" => 0])->all();
?>

<?php require("common/php/php-head.php"); ?>

<body>

<?php require("common/php/header.php"); ?>

<div class="main-container">
    <?php require("common/php/sidebar.php"); ?>

    <div class="main-content">
        <div class="item-wrapper one">

            <div class="item">
                <?php if($message) echo $message->format(); ?>

                <form data-validation="true" action="../private/controllers/cms.php" method="post" enctype="multipart/form-data">
                    <div class="item-inner">

                        <div class="item-header">
                            <h5 class="dplay-inl-b">Cms</h5>
                            <h5 class="float-r oflow-hidden">
                                <label class="status switch">
                                    <input type="checkbox" name="status"
                                    <?php if($cms->status == 1) echo "checked"; ?>/>
                                    <span class="slider round">
                                        <b class="active">Active</b>
                                        <b class="inactive">Inactive</b>
                                    </span>
                                </label>
                                <span class="toggle-title"></span>
                            </h5>
                        </div><!--item-header-->

                        <div class="item-content">							
                            <input type="hidden" name="id" value="<?php echo $cms->id; ?>">
                            <input type="hidden" name="created_by" value="<?php echo $cms->created_by; ?>">
							
							<label>Parent</label>
                            <select data-required="true" name="parent_id">
								<option value="0">Select Parent Menu</option>								
								<?php 
									if(!empty($parent_cms_array)){
										foreach($parent_cms_array as $parent_cms_val){
											$parent_cms_sel = "";
											if($cms->parent_id == $parent_cms_val->id){
												$parent_cms_sel = "selected";
											}											
								?>
											<option value="<?=(!empty($parent_cms_val->id)?$parent_cms_val->id:"")?>" <?=$parent_cms_sel?>><?=(!empty($parent_cms_val->name)?$parent_cms_val->name:"")?></option>
								<?php	
										}
									}
								?>
							</select>
							
							<label>Name</label>
                            <input type="text" data-required="true" placeholder="Name" name="name" value="<?php echo $cms->name; ?>"/>
							
                            <label>Title</label>
                            <input type="text" data-required="true" placeholder="Title" name="title" value="<?php echo $cms->title; ?>"/>

                            <label>Description</label>
                            <textarea data-required="true" class="desc" type="text" name="description"
                                          placeholder="Description"><?php echo $cms->description; ?></textarea>

                            <label>Sort Order</label>
                            <input type="text" data-required="true" placeholder="Sort Order" name="display_order" value="<?php echo $cms->display_order; ?>"/>
                            <div class="btn-wrapper"><button type="submit" class="demo-disable c-btn mb-10"><b>Save</b></button></div>

                            <?php if($errors) echo $errors->format(); ?>

                        </div><!--item-content-->
                    </div><!--item-inner-->

                </form>
            </div><!--item-->

        </div><!--item-wrapper-->
    </div><!--main-content-->

</div><!--main-container-->

 <?php echo "<script>adminId = '" . $admin->id  . "'</script>"; ?>

 <?php require("common/php/php-footer.php"); ?>

</body>