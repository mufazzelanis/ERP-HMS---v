<?php
if($page=="create-doctor"){
	$found=include("views/pages/doctor/create_doctor.php");
}elseif($page=="edit-doctor"){
	$found=include("views/pages/doctor/edit_doctor.php");
}elseif($page=="doctors"){
	$found=include("views/pages/doctor/manage_doctor.php");
}elseif($page=="details-doctor"){
	$found=include("views/pages/doctor/details_doctor.php");
}elseif($page=="view-doctor"){
	$found=include("views/pages/doctor/view_doctor.php");
}
?>