<?php
if(isset($_POST["btnCreate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtDob"])){
		$errors["dob"]="Invalid dob";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbGroupId"])){
		$errors["group_id"]="Invalid group_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbGenderId"])){
		$errors["gender_id"]="Invalid gender_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtAddress"])){
		$errors["address"]="Invalid address";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtContactNumber"])){
		$errors["contact_number"]="Invalid contact_number";
	}
	if(!is_valid_email($_POST["txtEmail"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtEmployer"])){
		$errors["employer"]="Invalid employer";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtInsuranceInfo"])){
		$errors["insurance_info"]="Invalid insurance_info";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbTypeId"])){
		$errors["type_id"]="Invalid type_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbDoctorId"])){
		$errors["doctor_id"]="Invalid doctor_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhoto"])){
		$errors["photo"]="Invalid photo";
	}

*/
	if(count($errors)==0){
		$patient=new Patient();
		$patient->name=$_POST["txtName"];
		$patient->dob=$_POST["txtDob"];
		$patient->groups_id=$_POST["cmbGroupId"];
		$patient->gender_id=$_POST["cmbGenderId"];
		$patient->address=$_POST["txtAddress"];
		$patient->contact_number=$_POST["txtContactNumber"];
		$patient->email=$_POST["txtEmail"];
		$patient->employer=$_POST["txtEmployer"];
		$patient->insurance_info=$_POST["txtInsuranceInfo"];
		$patient->type_id=$_POST["cmbTypeId"];
		$patient->doctor_id=$_POST["cmbDoctorId"];
		$patient->photo=upload($_FILES["filePhoto"], "img",date("YmdHis"));
		$patient->created_at=$now;
		$patient->updated_at=$now;

		$patient->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-info" href="patients">Manage Patient</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-patient' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Patient Name","type"=>"text","name"=>"txtName"]);
	$html.=input_field(["label"=>"Date of Birth","type"=>"date","name"=>"txtDob"]);
	$html.=select_field(["label"=>"Blood Group","name"=>"cmbGroupId","table"=>"groups"]);
	$html.=select_field(["label"=>"Sex","name"=>"cmbGenderId","table"=>"genders"]);
	$html.=input_field(["label"=>"Location","type"=>"text","name"=>"txtAddress"]);
	$html.=input_field(["label"=>"Mobile Number","type"=>"text","name"=>"txtContactNumber"]);
	$html.=input_field(["label"=>"Email Address","type"=>"text","name"=>"txtEmail"]);
	$html.=input_field(["label"=>"Designation","type"=>"text","name"=>"txtEmployer"]);
	$html.=input_field(["label"=>"Insurance Info","type"=>"text","name"=>"txtInsuranceInfo"]);
	$html.=select_field(["label"=>"Patient Type","name"=>"cmbTypeId","table"=>"types"]);
	$html.=select_field(["label"=>"Appointment Doctor","name"=>"cmbDoctorId","table"=>"doctors"]);
	$html.=input_field(["label"=>"Photo","type"=>"file","name"=>"filePhoto"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
