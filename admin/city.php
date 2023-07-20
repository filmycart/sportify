<?php require_once('../private/init.php'); ?>
<?php
	$allCity = array();
    $city = new City();

    $sort_by = "name";
    $sort_type = "ASC";

/*    echo $_POST["stateId"];
    exit;*/
	//if(Helper::is_post() && isset($_POST["stateId"])){
		$stateId = $_POST["stateId"];
		//$allCity = $city->where(["state_id" => $stateId])->orderBy($sort_by)->orderType($sort_type)->all();
		$allCity = (array) $city->where(["state_id" => $stateId])->orderBy($sort_by)->orderType($sort_type)->all();

		/*print"<pre>";
		print_r($allCity);
		exit;*/
	//}
?>
<select class="form-control select2 select2-danger" id="eventCity" name="eventCity" data-dropdown-css-class="select2-danger" style="width: 100%;">
    <?php
    	if(!empty($allCity)){
    		foreach($allCity as $allCityVal){
    ?>	
				<option value="<?php echo $allCityVal->id; ?>" ><?php echo $allCityVal->name; ?></option>
    <?php
    		}
    	}
    ?>
</select>