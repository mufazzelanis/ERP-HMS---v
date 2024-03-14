<?php
	echo main_sidebar_dropdown([
		"name"=>"Lab Tests",
		"icon"=>"nav-icon fas fa-flask",
		"links"=>[
			["route"=>"create-labetest","text"=>"New Test","icon"=>"fas fa-microscope nav-icon"],
			["route"=>"labe_tests","text"=>"Test List","icon"=>"fas fa-list-alt nav-icon"],
		]
	]);
?>
