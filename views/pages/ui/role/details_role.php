<?php
if(isset($_POST["btnDetails"])){
	$role=Role::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="roles">Manage Role</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Role Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$role->id</td></tr>";
		$html.="<tr><th>Name</th><td>$role->name</td></tr>";
		$html.="<tr><th>Updated At</th><td>$role->updated_at</td></tr>";
		$html.="<tr><th>Created At</th><td>$role->created_at</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
