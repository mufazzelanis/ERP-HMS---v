<?php
	echo main_sidebar_dropdown([
		"name"=>"User",
		"icon"=>"nav-icon fa fa-user-circle-o",
		"links"=>[
			["route"=>"create-user","text"=>"Create User","icon"=>"fa fa-plus-square nav-icon"],
			["route"=>"users","text"=>"Manage User","icon"=>"fa fa-list nav-icon"],
		]
	]);
?>
