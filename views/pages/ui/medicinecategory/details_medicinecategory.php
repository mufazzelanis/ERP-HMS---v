<?php
if(isset($_POST["btnDetails"])){
	$medicinecategory=MedicineCategory::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="medicine_categories">Manage MedicineCategory</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>MedicineCategory Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$medicinecategory->id</td></tr>";
		$html.="<tr><th>Name</th><td>$medicinecategory->name</td></tr>";
		$html.="<tr><th>Description</th><td>$medicinecategory->description</td></tr>";
		$html.="<tr><th>Created At</th><td>$medicinecategory->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$medicinecategory->updated_at</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
