<?php
if(isset($_POST["btnDetails"])){
	$appointment=Appointment::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="appointments">Manage Appointment</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Appointment Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$appointment->id</td></tr>";
		$html.="<tr><th>Patient Id</th><td>$appointment->patient_id</td></tr>";
		$html.="<tr><th>Doctor Id</th><td>$appointment->doctor_id</td></tr>";
		$html.="<tr><th>Appointment Date</th><td>$appointment->appointment_date</td></tr>";
		$html.="<tr><th>Appointment Time</th><td>$appointment->appointment_time</td></tr>";
		$html.="<tr><th>Created At</th><td>$appointment->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$appointment->updated_at</td></tr>";
		$html.="<tr><th>Appointment Status Id</th><td>$appointment->appointment_statuses_id</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
