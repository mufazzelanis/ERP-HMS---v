<?php
if(isset($_POST["btnEdit"])){
	$appointment=Appointment::find($_POST["txtId"]);
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
	if(!preg_match("/^[\s\S]+$/",$_POST["txtAppointmentDate"])){
		$errors["appointment_date"]="Invalid appointment_date";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtAppointmentTime"])){
		$errors["appointment_time"]="Invalid appointment_time";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbAppointmentStatusesId"])){
		$errors["appointment_statuses_id"]="Invalid appointment_statuses_id";
	}

*/
	if(count($errors)==0){
		$appointment=new Appointment();
		$appointment->id=$_POST["txtId"];
		$appointment->patient_id=$_POST["cmbPatientId"];
		$appointment->doctor_id=$_POST["cmbDoctorId"];
		$appointment->appointment_date=$_POST["txtAppointmentDate"];
		$appointment->appointment_time=$_POST["txtAppointmentTime"];
		$appointment->created_at=$now;
		$appointment->updated_at=$now;
		$appointment->appointment_statuses_id=$_POST["cmbAppointmentStatusesId"];

		$appointment->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="appointments">Manage Appointment</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-appointment' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$appointment->id"]);
	$html.=select_field(["label"=>"Patient","name"=>"cmbPatientId","table"=>"patients","value"=>"$appointment->patient_id"]);
	$html.=select_field(["label"=>"Doctor","name"=>"cmbDoctorId","table"=>"doctors","value"=>"$appointment->doctor_id"]);
	$html.=input_field(["label"=>"Appointment Date","type"=>"date","name"=>"txtAppointmentDate","value"=>"$appointment->appointment_date"]);
	$html.=input_field(["label"=>"Appointment Time","type"=>"time","name"=>"txtAppointmentTime","value"=>"$appointment->appointment_time"]);
	$html.=select_field(["label"=>"Appointment Status","name"=>"cmbAppointmentStatusesId","table"=>"appointment_statuses","value"=>"$appointment->appointment_statuses_id"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
