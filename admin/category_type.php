<?php require_once('./private/init.php'); ?>
<?php
	$allCategoryType = array();
    $categoryType = new Category_Type();

    $sort_by = "name";
    $sort_type = "ASC";
    $eventTypeId = $categoryTypeId = "";

	if(Helper::is_post()) {
        if((isset($_POST["eventTypeId"])) && (!empty($_POST["eventTypeId"]))) {
            $eventTypeId = $_POST["eventTypeId"];
        }

        if((isset($_POST["categoryTypeId"])) && (!empty($_POST["categoryTypeId"]))) {
            $categoryTypeId = $_POST["categoryTypeId"];
        }

        $allCategoryType = (array) $categoryType->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control select2 select2-danger" id="eventCategoryType" name="eventCategoryType" data-dropdown-css-class="select2-danger" style="width: 100%;">
    <?php
    	if(!empty($allCategoryType)){
    		foreach($allCategoryType as $allCategoryTypeVal) {
                $sel_event_type = "";
                if($allCategoryTypeVal->id == $categoryTypeId) {
                    $sel_event_type = "selected";
                }
    ?>	
				<option value="<?php echo $allCategoryTypeVal->id; ?>" <?php echo $sel_event_type; ?>><?php echo $allCategoryTypeVal->name; ?></option>
    <?php
    		}
    	}
    ?>
</select>
<script type="text/javascript">
    $("#eventCategory").change(function() {
        var eventCategorySelMultiValues = $(this).val();
        $("#eventCategoryHidden").val(eventCategorySelMultiValues);
    });
</script>