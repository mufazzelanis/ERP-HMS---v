<?php
	echo main_sidebar_dropdown([
		"name"=>"Bed",
		"icon"=>"nav-icon fa fa-bed",
		"links"=>[
			["route"=>"create-bed","text"=>"Create Bed","icon"=>"fa fa-plus-square nav-icon"],
			["route"=>"beds","text"=>"Manage Bed","icon"=>"fas fa-bed nav-icon"],
		]
	]);
?>
