<?php
if($page=="create-labetest"){
	$found=include("views/pages/ui/labetest/create_labetest.php");
}elseif($page=="edit-labetest"){
	$found=include("views/pages/ui/labetest/edit_labetest.php");
}elseif($page=="labe_tests"){
	$found=include("views/pages/ui/labetest/manage_labetest.php");
}elseif($page=="details-labetest"){
	$found=include("views/pages/ui/labetest/details_labetest.php");
}elseif($page=="view-labetest"){
	$found=include("views/pages/ui/labetest/view_labetest.php");
}
?>