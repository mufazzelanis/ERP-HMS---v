<?php
if($page=="create-department"){
	$found=include("views/pages/department/create_department.php");
}elseif($page=="edit-department"){
	$found=include("views/pages/department/edit_department.php");
}elseif($page=="departments"){
	$found=include("views/pages//department/manage_department.php");
}elseif($page=="details-department"){
	$found=include("views/pages/department/details_department.php");
}elseif($page=="view-department"){
	$found=include("views/pages/department/view_department.php");
}
?>
