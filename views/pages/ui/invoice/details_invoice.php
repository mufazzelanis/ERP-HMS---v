<?php
if(isset($_POST["btnDetails"])){
	$invoice=Invoice::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="invoices">Manage Invoice</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>Invoice Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$invoice->id</td></tr>";
		$html.="<tr><th>Patient Id</th><td>$invoice->patient_id</td></tr>";
		$html.="<tr><th>Doctor Id</th><td>$invoice->doctor_id</td></tr>";
		// $html.="<tr><th>Item</th><td>$invoice->item</td></tr>";
		$html.="<tr><th>Discount</th><td>$invoice->discount</td></tr>";
		$html.="<tr><th>Total</th><td>$invoice->total</td></tr>";
		$html.="<tr><th>Remark</th><td>$invoice->remark</td></tr>";
		$html.="<tr><th>Date</th><td>$invoice->invoice_date</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
