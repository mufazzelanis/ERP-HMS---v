<?php
if(isset($_POST["btnEdit"])){
	$appointmentstatuse=AppointmentStatuse::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtAppointmentStatus"])){
		$errors["appointment_status"]="Invalid appointment_status";
	}

*/
	if(count($errors)==0){
		$appointmentstatuse=new AppointmentStatuse();
		$appointmentstatuse->id=$_POST["txtId"];
		$appointmentstatuse->appointment_status=$_POST["txtAppointmentStatus"];

		$appointmentstatuse->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="appointment_statuses">Manage Appointment Status</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-appointmentstatuse' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$appointmentstatuse->id"]);
	$html.=input_field(["label"=>"Appointment Status","type"=>"text","name"=>"txtAppointmentStatus","value"=>"$appointmentstatuse->appointment_status"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
