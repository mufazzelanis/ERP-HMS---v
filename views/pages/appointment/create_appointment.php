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
		$appointment->patient_id=$_POST["cmbPatientId"];
		$appointment->doctor_id=$_POST["cmbDoctorId"];
		$appointment->appointment_date=$_POST["txtAppointmentDate"];
		$appointment->appointment_time=$_POST["txtAppointmentTime"];
		$appointment->created_at=$now;
		$appointment->updated_at=$now;
		$appointment->appointment_statuses_id=$_POST["cmbAppointmentStatusesId"];

		$appointment->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-info" href="appointments">Manage Appointment</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-appointment' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=select_field(["label"=>"Patient Name","name"=>"cmbPatientId","table"=>"patients"]);
	$html.=select_field(["label"=>"Doctor Name","name"=>"cmbDoctorId","table"=>"doctors"]);
	$html.=input_field(["label"=>"Scheduled Date","type"=>"date","name"=>"txtAppointmentDate"]);
	$html.=input_field(["label"=>"Scheduled Time","type"=>"time","name"=>"txtAppointmentTime"]);
	$html.=select_field(["label"=>"Appointment Status","name"=>"cmbAppointmentStatusesId","table"=>"appointment_statuses"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
