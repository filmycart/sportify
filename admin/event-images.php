<?php require_once('./private/init.php'); ?>
<?php
	$singleEvent = array();
    $event = new Event();

    $sort_by = "title";
    $sort_type = "ASC";
    $eventTypeId = "";

	if(Helper::is_post()) {
        if((isset($_POST["eventId"])) && (!empty($_POST["eventId"]))) {
            $eventId = $_POST["eventId"];
        }

		$singleEvent = (array) $event->where(["id" => $eventId])->one();
	}

    $eventImageNameArr = array();
    if((isset($singleEvent['image_name'])) && (!empty($singleEvent['image_name']))) {
        $eventImageNameArr = explode(",",$singleEvent['image_name']);
    }

	if(!empty($eventImageNameArr)) {
		foreach($eventImageNameArr as $singleEventImgVal) {
?>	
		    <div><a href ="uploads/events/<?php echo $singleEventImgVal ?>" target="_blank" id="<?php echo $singleEventImgVal; ?>"><?php echo $singleEventImgVal ?></a></div>
<?php
		}
	}
?>
