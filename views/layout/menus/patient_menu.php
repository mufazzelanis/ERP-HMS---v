<?php
	echo main_sidebar_dropdown([
		"name"=>"Patient",
		"icon"=>"nav-icon fas fa-user-injured",
		"links"=>[
			["route"=>"create-patient","text"=>"Add Patient","icon"=>"fa fa-user-plus nav-icon"],
			["route"=>"patients","text"=>"Manage Patient","icon"=>"fa fa-list nav-icon"],
		]
	]);
?>
