<?php require_once('../private/init.php'); ?>
<?php
	$allState = array();
    $state = new State();

    $sort_by = "name";
    $sort_type = "ASC";
    $countryId = "";
    $stateSelId = "";    
    $stateSel = "";
	if(Helper::is_post() && isset($_POST["countryId"])){
		$countryId = $_POST["countryId"];
        $stateSelId = $_POST["stateSelId"];
		$allState = (array) $state->where(["country_id" => $countryId])->orderBy($sort_by)->orderType($sort_type)->all();
	}    

	/*print"<pre>";
	print_r($stateSelId);
    exit;*/

    /*if(!empty($stateSelId)) {
        $stateSel = "";
    }*/
?>
<select class="form-control select2 select2-danger" id="eventState" name="eventState" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="eventCity(this.value)">
    <?php
    	if(!empty($allState)){
    		foreach($allState as $allStateVal){
                if(!empty($stateSelId)) {
                    if($stateSelId == $allStateVal->id) {
                        $stateSel = "selected";
                    } else {
                        $stateSel = "";
                    }
                }
    ?>	
				<option value="<?php echo $allStateVal->id; ?>" <?php echo $stateSel; ?> ><?php echo $allStateVal->name; ?>
                </option>
    <?php
    		}
    	}
    ?>
</select>