<?php
	echo main_sidebar_dropdown([
		"name"=>"Appointment",
		"icon"=>"nav-icon fa fa-calendar-o",
		"links"=>[
			["route"=>"create-appointment","text"=>"New Appointment","icon"=>"nav-icon fa fa-calendar-check-o"],
			["route"=>"appointments","text"=>"Manage Appointment","icon"=>"fa fa-list nav-icon"],
		]
	]);
?>
