<?php
if(isset($_POST["btnDetails"])){
	$gender=Gender::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="genders">Manage Gender</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Gender Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$gender->id</td></tr>";
		$html.="<tr><th>Gender</th><td>$gender->gender</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
