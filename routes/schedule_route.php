<?php
if($page=="create-schedule"){
	$found=include("views/pages/schedule/create_schedule.php");
}elseif($page=="edit-schedule"){
	$found=include("views/pages/schedule/edit_schedule.php");
}elseif($page=="schedules"){
	$found=include("views/pages/schedule/manage_schedule.php");
}elseif($page=="details-schedule"){
	$found=include("views/pages/schedule/details_schedule.php");
}elseif($page=="view-schedule"){
	$found=include("views/pages/schedule/view_schedule.php");
}
?>
