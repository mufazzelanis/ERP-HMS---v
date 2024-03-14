<?php
	echo main_sidebar_dropdown([
		"name"=>"Schedule",
		"icon"=>"nav-icon fa fa-clock-o",
		"links"=>[
			["route"=>"create-schedule","text"=>"Create Schedule","icon"=>"fa fa-calendar-plus-o nav-icon"],
			["route"=>"schedules","text"=>"Manage Schedule","icon"=>"fa fa-list nav-icon"],
		]
	]);
?>
