<?php
if(isset($_POST["btnDetails"])){
	$bed=Bed::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="beds">Manage Bed</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Bed Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$bed->id</td></tr>";
		$html.="<tr><th>Name</th><td>$bed->name</td></tr>";
		$html.="<tr><th>Category Id</th><td>$bed->category_id</td></tr>";
		$html.="<tr><th>Room Id</th><td>$bed->room_id</td></tr>";
		$html.="<tr><th>Status Id</th><td>$bed->status_id</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
