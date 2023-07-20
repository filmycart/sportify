<?php require_once('../private/init.php'); ?>
<?php
	$allCategory = array();
    $category = new Category();

    $sort_by = "title";
    $sort_type = "ASC";
	//if(Helper::is_post() && isset($_POST["parentCategoryId"])){
		//$parentCategoryId = $_POST["parentCategoryId"];
		$allCategory = (array) $category->where(["parent_id" => 0])->orderBy($sort_by)->orderType($sort_type)->all();
	//}
?>
<select class="form-control select2 select2-danger" id="eventCategory" name="eventCategory" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="eventCity(this.value)">
    <?php
    	if(!empty($allCategory)){
    		foreach($allCategory as $allCategoryVal){
    ?>	
				<option value="<?php echo $allCategoryVal->id; ?>" ><?php echo $allCategoryVal->title; ?></option>
    <?php
    		}
    	}
    ?>
</select>