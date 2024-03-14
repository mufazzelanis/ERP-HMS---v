<?php
if(isset($_POST["btnDetails"])){
	$appointmentstatuse=AppointmentStatuse::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="appointment_statuses">Manage Appointment Status</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Appointment Status Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$appointmentstatuse->id</td></tr>";
		$html.="<tr><th>Appointment Status</th><td>$appointmentstatuse->appointment_status</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
