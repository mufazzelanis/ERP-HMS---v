<?php
	echo main_sidebar_dropdown([
		"name"=>"Department",
		"icon"=>"nav-icon fas fa-hospital",
		"links"=>[
			["route"=>"create-department","text"=>"Add Department","icon"=>"fas fa-sitemap nav-icon"],
			["route"=>"departments","text"=>"Manage Department","icon"=>"fas fa-sync-alt nav-icon"],
		]
	]);
?>
