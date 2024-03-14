<?php
if(isset($_POST["btnEdit"])){
	$patient=Patient::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtDob"])){
		$errors["dob"]="Invalid dob";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbGroupsId"])){
		$errors["groups_id"]="Invalid groups_id";
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
		$patient->id=$_POST["txtId"];
		$patient->name=$_POST["txtName"];
		$patient->dob=$_POST["txtDob"];
		$patient->groups_id=$_POST["cmbGroupsId"];
		$patient->gender_id=$_POST["cmbGenderId"];
		$patient->address=$_POST["txtAddress"];
		$patient->contact_number=$_POST["txtContactNumber"];
		$patient->email=$_POST["txtEmail"];
		$patient->employer=$_POST["txtEmployer"];
		$patient->insurance_info=$_POST["txtInsuranceInfo"];
		$patient->type_id=$_POST["cmbTypeId"];
		$patient->doctor_id=$_POST["cmbDoctorId"];
		if($_FILES["filePhoto"]["name"]!=""){
			$patient->photo=upload($_FILES["filePhoto"], "img",$_POST["txtId"]);
		}else{
			$patient->photo=Patient::find($_POST["txtId"])->photo;
		}
		$patient->created_at=$now;
		$patient->updated_at=$now;

		$patient->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="patients">Manage Patient</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-patient' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$patient->id"]);
	$html.=input_field(["label"=>"Name","type"=>"text","name"=>"txtName","value"=>"$patient->name"]);
	$html.=input_field(["label"=>"Dob","type"=>"text","name"=>"txtDob","value"=>"$patient->dob"]);
	$html.=select_field(["label"=>"Groups","name"=>"cmbGroupsId","table"=>"groups","value"=>"$patient->groups_id"]);
	$html.=select_field(["label"=>"Gender","name"=>"cmbGenderId","table"=>"genders","value"=>"$patient->gender_id"]);
	$html.=input_field(["label"=>"Address","type"=>"text","name"=>"txtAddress","value"=>"$patient->address"]);
	$html.=input_field(["label"=>"Contact Number","type"=>"text","name"=>"txtContactNumber","value"=>"$patient->contact_number"]);
	$html.=input_field(["label"=>"Email","type"=>"text","name"=>"txtEmail","value"=>"$patient->email"]);
	$html.=input_field(["label"=>"Employer","type"=>"text","name"=>"txtEmployer","value"=>"$patient->employer"]);
	$html.=input_field(["label"=>"Insurance Info","type"=>"text","name"=>"txtInsuranceInfo","value"=>"$patient->insurance_info"]);
	$html.=select_field(["label"=>"Type","name"=>"cmbTypeId","table"=>"types","value"=>"$patient->type_id"]);
	$html.=select_field(["label"=>"Doctor","name"=>"cmbDoctorId","table"=>"doctors","value"=>"$patient->doctor_id"]);
	$html.=input_field(["label"=>"Photo","type"=>"file","name"=>"filePhoto"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
