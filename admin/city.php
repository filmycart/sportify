<?php require_once('./private/init.php'); ?>
<?php
	$allCity = array();
    $city = new City();

    $sort_by = "name";
    $sort_type = "ASC";
    $cityId = "";
    
	if(Helper::is_post() && isset($_POST["stateId"])){
		$stateId = $_POST["stateId"];
        if((isset($_POST["cityId"])) && (!empty($_POST["cityId"]))) {
            $cityId = $_POST["cityId"];
        }
		$allCity = (array) $city->where(["state_id" => $stateId])->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control select2 select2-danger" id="eventCity" name="eventCity" data-dropdown-css-class="select2-danger" style="width: 100%;">
    <?php
    	if(!empty($allCity)){
    		foreach($allCity as $allCityVal){
                $sel_city = "";
                if($allCityVal->id == $cityId) {
                    $sel_city = "selected";
                }
    ?>	
				<option value="<?php echo $allCityVal->id; ?>" <?php echo $sel_city; ?> ><?php echo $allCityVal->name; ?></option>
    <?php
    		}
    	}
    ?>
</select>