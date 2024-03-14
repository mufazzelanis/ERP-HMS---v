<?php
	echo main_sidebar_dropdown([
		"name"=>"Doctor",
		"icon"=>"nav-icon fas fa-user-md",
		"links"=>[
			["route"=>"create-doctor","text"=>"Create Doctor","icon"=>"fa fa-user-plus nav-icon"],
			["route"=>"doctors","text"=>"Doctor List","icon"=>"fas fa-clipboard-list nav-icon"],
		]
	]);
?>
