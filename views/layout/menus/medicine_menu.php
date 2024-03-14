<?php
	echo main_sidebar_dropdown([
		"name"=>"Medicine",
		"icon"=>"nav-icon fas fa-pills",
		"links"=>[
			["route"=>"create-medicine","text"=>"Add Medicine","icon"=>"fa fa-plus-square nav-icon"],
			["route"=>"medicines","text"=>"Medicine List","icon"=>"fas fa-clipboard-list nav-icon"],
			["route"=>"create-medicinecategory","text"=>"Create Category","icon"=>"fa fa-align-center nav-icon"],
			["route"=>"medicine_categories","text"=>"Manage Category","icon"=>"fa fa-building-o nav-icon"],
		]
	]);
?>
