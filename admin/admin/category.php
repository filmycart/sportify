<?php require_once('./private/init.php'); ?>
<?php
	$allCategory = array();
    $category = new Category();

    $sort_by = "title";
    $sort_type = "ASC";

	if(Helper::is_post()) {
        $categoryId = $_POST["categoryId"];
		$allCategory = (array) $category->where(["parent_id" => 0])->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control select2 select2-danger" id="eventCategory" name="eventCategory" data-dropdown-css-class="select2-danger" style="width: 100%;">
    <?php
    	if(!empty($allCategory)){
    		foreach($allCategory as $allCategoryVal) {
                $sel_category = "";
                if($allCategoryVal->id == $categoryId) {
                    $sel_category = "selected";
                }
    ?>	
				<option value="<?php echo $allCategoryVal->id; ?>" <?php echo $sel_category; ?>><?php echo $allCategoryVal->title; ?></option>
    <?php
    		}
    	}
    ?>
</select>
<script type="text/javascript">
    $("#eventCategory").change(function() {
        var categoryId = $("#eventCategory").val();
        $.ajax({
            url: "sub_category.php",
            cache: false,
            type: "POST",
            data: {categoryId : categoryId},
            success: function(html){
                $("#eventSubCategoryDiv").html(html);
            }
        });
    });
</script>