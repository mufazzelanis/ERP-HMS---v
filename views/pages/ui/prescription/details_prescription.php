<?php
if(isset($_POST["btnDetails"])){
	$prescription=Prescription::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="prescriptions">Manage Prescription</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Prescription Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$prescription->id</td></tr>";
		$html.="<tr><th>Patient Id</th><td>$prescription->patient_id</td></tr>";
		$html.="<tr><th>Doctor Id</th><td>$prescription->doctor_id</td></tr>";
		$html.="<tr><th>Appointment Id</th><td>$prescription->appointment_id</td></tr>";
		$html.="<tr><th>Prescription Date</th><td>$prescription->prescription_date</td></tr>";
		$html.="<tr><th>History</th><td>$prescription->history</td></tr>";
		$html.="<tr><th>Advice</th><td>$prescription->advice</td></tr>";
		$html.="<tr><th>Note</th><td>$prescription->note</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
