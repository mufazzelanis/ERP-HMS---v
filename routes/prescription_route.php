<?php
if($page=="create-prescription"){
	$found=include("views/pages/ui/prescription/create_prescription.php");
}elseif($page=="edit-prescription"){
	$found=include("views/pages/ui/prescription/edit_prescription.php");
}elseif($page=="prescriptions"){
	$found=include("views/pages/ui/prescription/manage_prescription.php");
}elseif($page=="details-prescription"){
	$found=include("views/pages/ui/prescription/details_prescription.php");
}elseif($page=="view-prescription"){
	$found=include("views/pages/ui/prescription/view_prescription.php");
}
?>
