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
	if(!preg_match("/^[\s\S]+$/",$_POST["txtNote"])){
		$errors["note"]="Invalid note";
	}

*/
	if(count($errors)==0){
		$prescription=new Prescription();
		$prescription->id=$_POST["txtId"];
		$prescription->patient_id=$_POST["cmbPatientId"];
		$prescription->doctor_id=$_POST["cmbDoctorId"];
		// $prescription->appointment_id=$_POST["cmbAppointmentId"];
		$prescription->prescription_date=$_POST["txtPrescriptionDate"];
		$prescription->history=$_POST["txtHistory"];
		$prescription->advice=$_POST["txtAdvice"];
		$prescription->note=$_POST["txtNote"];

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
	// $html.=select_field(["label"=>"Appointment","name"=>"cmbAppointmentId","table"=>"appointments","value"=>"$prescription->appointment_id"]);
	$html.=input_field(["label"=>"Prescription Date","type"=>"text","name"=>"txtPrescriptionDate","value"=>"$prescription->prescription_date"]);
	$html.=input_field(["label"=>"History","type"=>"text","name"=>"txtHistory","value"=>"$prescription->history"]);
	$html.=input_field(["label"=>"Advice","type"=>"text","name"=>"txtAdvice","value"=>"$prescription->advice"]);
	$html.=input_field(["label"=>"Note","type"=>"text","name"=>"txtNote","value"=>"$prescription->note"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
