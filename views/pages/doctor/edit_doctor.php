<?php
if(isset($_POST["btnEdit"])){
	$doctor=Doctor::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
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
		$doctor->id=$_POST["txtId"];
		$doctor->name=$_POST["txtName"];
		$doctor->department_id=$_POST["cmbDepartmentId"];
		$doctor->phone_number=$_POST["txtPhoneNumber"];
		$doctor->address=$_POST["txtAddress"];
		$doctor->designation=$_POST["txtDesignation"];
		$doctor->email=$_POST["txtEmail"];
		$doctor->fees=$_POST["txtFees"];
		$doctor->available_appointments=$_POST["txtAvailableAppointments"];

		$doctor->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="doctors">Manage Doctor</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-doctor' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$doctor->id"]);
	$html.=input_field(["label"=>"Name","type"=>"text","name"=>"txtName","value"=>"$doctor->name"]);
	$html.=select_field(["label"=>"Department","name"=>"cmbDepartmentId","table"=>"departments","value"=>"$doctor->department_id"]);
	$html.=input_field(["label"=>"Phone Number","type"=>"text","name"=>"txtPhoneNumber","value"=>"$doctor->phone_number"]);
	$html.=input_field(["label"=>"Address","type"=>"text","name"=>"txtAddress","value"=>"$doctor->address"]);
	$html.=input_field(["label"=>"Designation","type"=>"text","name"=>"txtDesignation","value"=>"$doctor->designation"]);
	$html.=input_field(["label"=>"Email","type"=>"text","name"=>"txtEmail","value"=>"$doctor->email"]);
	$html.=input_field(["label"=>"Fees","type"=>"text","name"=>"txtFees","value"=>"$doctor->fees"]);
	$html.=input_field(["label"=>"Available Appointments","type"=>"text","name"=>"txtAvailableAppointments","value"=>"$doctor->available_appointments"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
