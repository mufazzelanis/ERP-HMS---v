<?php
if(isset($_POST["btnDetails"])){
	$department=Department::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="departments">Manage Department</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Department Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$department->id</td></tr>";
		$html.="<tr><th>Name</th><td>$department->name</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
