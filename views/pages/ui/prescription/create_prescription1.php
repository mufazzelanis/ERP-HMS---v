<?php
if(isset($_POST["btnCreate"])){
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
		$prescription->patient_id=$_POST["cmbPatientId"];
		$prescription->doctor_id=$_POST["cmbDoctorId"];
		$prescription->appointment_id=$_POST["cmbAppointmentId"];
		$prescription->prescription_date=$_POST["txtPrescriptionDate"];
		$prescription->history=$_POST["txtHistory"];
		$prescription->advice=$_POST["txtAdvice"];
		$prescription->note=$_POST["txtNote"];

		$prescription->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="prescriptions">Manage Prescription</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-prescription' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=select_field(["label"=>"Patient","name"=>"cmbPatientId","table"=>"patients"]);
	$html.=select_field(["label"=>"Doctor","name"=>"cmbDoctorId","table"=>"doctors"]);
	$html.=select_field(["label"=>"Appointment","name"=>"cmbAppointmentId","table"=>"appointments"]);
	$html.=input_field(["label"=>"Prescription Date","type"=>"text","name"=>"txtPrescriptionDate"]);
	$html.=input_field(["label"=>"History","type"=>"text","name"=>"txtHistory"]);
	$html.=input_field(["label"=>"Advice","type"=>"text","name"=>"txtAdvice"]);
	$html.=input_field(["label"=>"Note","type"=>"text","name"=>"txtNote"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
