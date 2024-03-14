<?php
if(isset($_POST["btnDetails"])){
	$doctor=Doctor::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="doctors">Manage Doctor</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Doctor Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$doctor->id</td></tr>";
		$html.="<tr><th>Name</th><td>$doctor->name</td></tr>";
		$html.="<tr><th>Department Id</th><td>$doctor->department_id</td></tr>";
		$html.="<tr><th>Phone Number</th><td>$doctor->phone_number</td></tr>";
		$html.="<tr><th>Address</th><td>$doctor->address</td></tr>";
		$html.="<tr><th>Designation</th><td>$doctor->designation</td></tr>";
		$html.="<tr><th>Email</th><td>$doctor->email</td></tr>";
		$html.="<tr><th>Fees</th><td>$doctor->fees</td></tr>";
		$html.="<tr><th>Available Appointments</th><td>$doctor->available_appointments</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
