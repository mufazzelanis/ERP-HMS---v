<?php
	echo main_sidebar_dropdown([
		"name"=>"MedicineCategory",
		"icon"=>"nav-icon fa fa-wrench",
		"links"=>[
			["route"=>"create-medicinecategory","text"=>"Create MedicineCategory","icon"=>"far fa-circle nav-icon"],
			["route"=>"medicine_categories","text"=>"Manage MedicineCategory","icon"=>"far fa-circle nav-icon"],
		]
	]);
?>
