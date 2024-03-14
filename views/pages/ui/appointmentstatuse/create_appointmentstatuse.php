<?php
if(isset($_POST["btnCreate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtAppointmentStatus"])){
		$errors["appointment_status"]="Invalid appointment_status";
	}

*/
	if(count($errors)==0){
		$appointmentstatuse=new AppointmentStatuse();
		$appointmentstatuse->appointment_status=$_POST["txtAppointmentStatus"];

		$appointmentstatuse->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="appointment_statuses">Manage Appointment Status</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-appointmentstatuse' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Appointment Status","type"=>"text","name"=>"txtAppointmentStatus"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
