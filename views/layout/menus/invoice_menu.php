<?php
	echo main_sidebar_dropdown([
		"name"=>"Financial",
		"icon"=>"nav-icon fa fa-credit-card",
		"links"=>[
			["route"=>"create-invoice","text"=>"Create Invoice","icon"=>"fas fa-file-invoice nav-icon"],
			["route"=>"invoices","text"=>"Invoice List","icon"=>"fas fa-list-alt nav-icon"],
		]
	]);
?>
