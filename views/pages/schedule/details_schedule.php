<?php
if(isset($_POST["btnDetails"])){
	$schedule=Schedule::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="schedules">Manage Schedule</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Schedule Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$schedule->id</td></tr>";
		$html.="<tr><th>Doctor Id</th><td>$schedule->doctor_id</td></tr>";
		$html.="<tr><th>Weekday Id</th><td>$schedule->weekday_id</td></tr>";
		$html.="<tr><th>Start Time</th><td>$schedule->start_time</td></tr>";
		$html.="<tr><th>End Time</th><td>$schedule->end_time</td></tr>";
		$html.="<tr><th>Duration</th><td>$schedule->duration</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
