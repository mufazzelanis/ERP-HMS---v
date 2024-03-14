<?php
	echo main_sidebar_dropdown([
		"name"=>"Prescription",
		"icon"=>"nav-icon fas fa-prescription",
		"links"=>[
			["route"=>"create-prescription","text"=>"Create Prescription","icon"=>"fas fa-prescription-bottle nav-icon"],
			["route"=>"prescriptions","text"=>"Manage Prescription","icon"=>"fas fa-cogs nav-icon"],
		]
	]);
?>
