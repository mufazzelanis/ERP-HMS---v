<?php
if(isset($_POST["btnCreate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbDepartmentId"])){
		$errors["department_id"]="Invalid department_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhoneNumber"])){
		$errors["phone_number"]="Invalid phone_number";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtAddress"])){
		$errors["address"]="Invalid address";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtDesignation"])){
		$errors["designation"]="Invalid designation";
	}
	if(!is_valid_email($_POST["txtEmail"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtFees"])){
		$errors["fees"]="Invalid fees";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtAvailableAppointments"])){
		$errors["available_appointments"]="Invalid available_appointments";
	}

*/
	if(count($errors)==0){
		$doctor=new Doctor();
		$doctor->name=$_POST["txtName"];
		$doctor->department_id=$_POST["cmbDepartmentId"];
		$doctor->phone_number=$_POST["txtPhoneNumber"];
		$doctor->address=$_POST["txtAddress"];
		$doctor->designation=$_POST["txtDesignation"];
		$doctor->email=$_POST["txtEmail"];
		$doctor->fees=$_POST["txtFees"];
		$doctor->available_appointments=$_POST["txtAvailableAppointments"];

		$doctor->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-info" href="doctors">Manage Doctor</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-doctor' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Doctor Name","type"=>"text","name"=>"txtName"]);
	$html.=select_field(["label"=>"Department Name","name"=>"cmbDepartmentId","table"=>"departments"]);
	$html.=input_field(["label"=>"Mobile Number","type"=>"text","name"=>"txtPhoneNumber"]);
	$html.=input_field(["label"=>"Location","type"=>"text","name"=>"txtAddress"]);
	$html.=input_field(["label"=>"Designation","type"=>"text","name"=>"txtDesignation"]);
	$html.=input_field(["label"=>"Email Address","type"=>"text","name"=>"txtEmail"]);
	$html.=input_field(["label"=>"Appointment Fee","type"=>"text","name"=>"txtFees"]);
	$html.=input_field(["label"=>"Available Appoint","type"=>"text","name"=>"txtAvailableAppointments"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
