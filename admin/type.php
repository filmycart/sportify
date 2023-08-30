<?php require_once('./private/init.php'); ?>
<?php
	$allType = array();
    $eventType = new Event_Type();

    $sort_by = "name";
    $sort_type = "DESC";
    $eventTypeId = "";

	if(Helper::is_post()) {
        if((isset($_POST["eventTypeId"])) && (!empty($_POST["eventTypeId"]))) {
            $eventTypeId = $_POST["eventTypeId"];
        } 

        /*if((isset($_POST["eventTypeId"])) && (!empty($_POST["eventTypeId"]))) {
            $eventTypeId = explode("','", $_POST["eventTypeId"]);
            $allType = (array) $eventType->where(["type_id" => $eventTypeId])->orderBy($sort_by)->orderType($sort_type)->all();
        } else{
            $allType = (array) $eventType->where(["status" => 1])->orderBy($sort_by)->orderType($sort_type)->all();
        }*/

        $allType = (array) $eventType->where(["status" => 1])->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control select2 select2-danger" id="eventType" name="eventType" data-dropdown-css-class="select2-danger" style="width: 100%;">
    <?php
    	if(!empty($allType)){
    		foreach($allType as $allTypeVal) {
                $sel_event_type = "";
                if($allTypeVal->id == $eventTypeId) {
                    $sel_event_type = "selected";
                }
    ?>	
				<option value="<?php echo $allTypeVal->id; ?>" <?php echo $sel_event_type; ?>><?php echo $allTypeVal->name; ?></option>
    <?php
    		}
    	}
    ?>
</select>
<script type="text/javascript">
   /* $("#eventType").change(function() {
        var eventTypeSelMultiValues = $(this).val();
        $("#eventTypeHidden").val(eventTypeSelMultiValues);
    }); */

    $("#eventType").change(function() {
        var eventTypeId = $("#eventType").val();
        var categoryId = $("#categoryId").val();
        $.ajax({
            url: "category.php",
            cache: false,
            type: "POST",
            data: {categoryId : categoryId, eventTypeId : eventTypeId},
            success: function(html){
                $("#eventCategoryDiv").html(html);
            }
        });

        $.ajax({
            url: "category_type.php",
            cache: false,
            type: "POST",
            data: {categoryId : categoryId},
            beforeSend: function() {
                $('#categoryTypeSpinnerDiv').show();
            },
            complete: function(){
                $('#categoryTypeSpinnerDiv').hide();
            },
            success: function(html){
                $("#eventCategoryTypeDiv").html(html);
            }
        });
    });
</script>