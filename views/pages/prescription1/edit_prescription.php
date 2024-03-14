<?php
if(isset($_POST["btnEdit"])){
	$prescription=Prescription::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbPatientId"])){
		$errors["patient_id"]="Invalid patient_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbDoctorId"])){
		$errors["doctor_id"]="Invalid doctor_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbAppointmentId"])){
		$errors["appointment_id"]="Invalid appointment_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPrescriptionDate"])){
		$errors["prescription_date"]="Invalid prescription_date";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtHistory"])){
		$errors["history"]="Invalid history";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtAdvice"])){
		$errors["advice"]="Invalid advice";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtFollowUp"])){
		$errors["follow_up"]="Invalid follow_up";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPWeight"])){
		$errors["p_weight"]="Invalid p_weight";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtTemperature"])){
		$errors["temperature"]="Invalid temperature";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtBloodPressure"])){
		$errors["blood_pressure"]="Invalid blood_pressure";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtSpo2"])){
		$errors["spo2"]="Invalid spo2";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtHeartRate"])){
		$errors["heart_rate"]="Invalid heart_rate";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtCc"])){
		$errors["cc"]="Invalid cc";
	}

*/
	if(count($errors)==0){
		$prescription=new Prescription();
		$prescription->id=$_POST["txtId"];
		$prescription->patient_id=$_POST["cmbPatientId"];
		$prescription->doctor_id=$_POST["cmbDoctorId"];
		$prescription->appointment_id=$_POST["cmbAppointmentId"];
		$prescription->prescription_date=$_POST["txtPrescriptionDate"];
		$prescription->history=$_POST["txtHistory"];
		$prescription->advice=$_POST["txtAdvice"];
		$prescription->follow_up=$_POST["txtFollowUp"];
		$prescription->p_weight=$_POST["txtPWeight"];
		$prescription->temperature=$_POST["txtTemperature"];
		$prescription->blood_pressure=$_POST["txtBloodPressure"];
		$prescription->spo2=$_POST["txtSpo2"];
		$prescription->heart_rate=$_POST["txtHeartRate"];
		$prescription->cc=$_POST["txtCc"];

		$prescription->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="prescriptions">Manage Prescription</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-prescription' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$prescription->id"]);
	$html.=select_field(["label"=>"Patient","name"=>"cmbPatientId","table"=>"patients","value"=>"$prescription->patient_id"]);
	$html.=select_field(["label"=>"Doctor","name"=>"cmbDoctorId","table"=>"doctors","value"=>"$prescription->doctor_id"]);
	$html.=select_field(["label"=>"Appointment","name"=>"cmbAppointmentId","table"=>"appointments","value"=>"$prescription->appointment_id"]);
	$html.=input_field(["label"=>"Prescription Date","type"=>"text","name"=>"txtPrescriptionDate","value"=>"$prescription->prescription_date"]);
	$html.=input_field(["label"=>"History","type"=>"text","name"=>"txtHistory","value"=>"$prescription->history"]);
	$html.=input_field(["label"=>"Advice","type"=>"text","name"=>"txtAdvice","value"=>"$prescription->advice"]);
	$html.=input_field(["label"=>"Follow Up","type"=>"text","name"=>"txtFollowUp","value"=>"$prescription->follow_up"]);
	$html.=input_field(["label"=>"P Weight","type"=>"text","name"=>"txtPWeight","value"=>"$prescription->p_weight"]);
	$html.=input_field(["label"=>"Temperature","type"=>"text","name"=>"txtTemperature","value"=>"$prescription->temperature"]);
	$html.=input_field(["label"=>"Blood Pressure","type"=>"text","name"=>"txtBloodPressure","value"=>"$prescription->blood_pressure"]);
	$html.=input_field(["label"=>"Spo2","type"=>"text","name"=>"txtSpo2","value"=>"$prescription->spo2"]);
	$html.=input_field(["label"=>"Heart Rate","type"=>"text","name"=>"txtHeartRate","value"=>"$prescription->heart_rate"]);
	$html.=input_field(["label"=>"Cc","type"=>"text","name"=>"txtCc","value"=>"$prescription->cc"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
