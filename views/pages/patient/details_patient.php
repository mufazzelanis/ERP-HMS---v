<?php
if(isset($_POST["btnDetails"])){
	$patient=Patient::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="patients">Manage Patient</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Patient Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$patient->id</td></tr>";
		$html.="<tr><th>Name</th><td>$patient->name</td></tr>";
		$html.="<tr><th>Dob</th><td>$patient->dob</td></tr>";
		$html.="<tr><th>Groups Id</th><td>$patient->groups_id</td></tr>";
		$html.="<tr><th>Gender Id</th><td>$patient->gender_id</td></tr>";
		$html.="<tr><th>Address</th><td>$patient->address</td></tr>";
		$html.="<tr><th>Contact Number</th><td>$patient->contact_number</td></tr>";
		$html.="<tr><th>Email</th><td>$patient->email</td></tr>";
		$html.="<tr><th>Employer</th><td>$patient->employer</td></tr>";
		$html.="<tr><th>Insurance Info</th><td>$patient->insurance_info</td></tr>";
		$html.="<tr><th>Type Id</th><td>$patient->type_id</td></tr>";
		$html.="<tr><th>Doctor Id</th><td>$patient->doctor_id</td></tr>";
		$html.="<tr><th>Photo</th><td><img src=\"img/$patient->photo\" width=\"100\" /></td></tr>";
		$html.="<tr><th>Created At</th><td>$patient->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$patient->updated_at</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
