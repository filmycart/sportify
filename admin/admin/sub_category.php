<?php require_once('./private/init.php'); ?>
<?php
	$allCategory = array();
    $category = new Category();

    $sort_by = "title";
    $sort_type = "ASC";
    $subCategoryId = "";

	if(Helper::is_post() && isset($_POST["categoryId"])) {
        $categoryId = $_POST["categoryId"];        
        if((isset($_POST["subCategoryId"])) && (!empty($_POST["subCategoryId"]))) {
            $subCategoryId = $_POST["subCategoryId"];
        }
		$allCategory = (array) $category->where(["parent_id" => $categoryId])->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control select2 select2-danger" id="eventSubCategory" name="eventSubCategory" data-dropdown-css-class="select2-danger" style="width: 100%;">
    <?php
    	if(!empty($allCategory)){
    		foreach($allCategory as $allCategoryVal) {
                $sel_sub_category = "";
                if($allCategoryVal->id == $subCategoryId) {
                    $sel_sub_category = "selected";
                }
    ?>	
				<option value="<?php echo $allCategoryVal->id; ?>" <?php echo $sel_sub_category; ?>><?php echo $allCategoryVal->title; ?></option>
    <?php
    		}
    	}
    ?>
</select>