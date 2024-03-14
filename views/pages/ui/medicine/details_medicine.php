<?php
if(isset($_POST["btnDetails"])){
	$medicine=Medicine::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="medicines">Manage Medicine</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Medicine Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$medicine->id</td></tr>";
		$html.="<tr><th>Name</th><td>$medicine->name</td></tr>";
		$html.="<tr><th>Category Id</th><td>$medicine->category_id</td></tr>";
		$html.="<tr><th>Purchase Price</th><td>$medicine->purchase_price</td></tr>";
		$html.="<tr><th>Sale Price</th><td>$medicine->sale_price</td></tr>";
		$html.="<tr><th>Store Box</th><td>$medicine->store_box</td></tr>";
		$html.="<tr><th>Quantity</th><td>$medicine->quantity</td></tr>";
		$html.="<tr><th>Generic Name</th><td>$medicine->generic_name</td></tr>";
		$html.="<tr><th>Company</th><td>$medicine->company</td></tr>";
		$html.="<tr><th>Effects</th><td>$medicine->effects</td></tr>";
		$html.="<tr><th>Expire Date</th><td>$medicine->expire_date</td></tr>";
		$html.="<tr><th>Created At</th><td>$medicine->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$medicine->updated_at</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
