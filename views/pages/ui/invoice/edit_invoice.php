<?php
if(isset($_POST["btnEdit"])){
	$invoice=Invoice::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbPatientId"])){
		$errors["patient_id"]="Invalid patient_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbDoctorId"])){
		$errors["doctor_id"]="Invalid doctor_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtItem"])){
		$errors["item"]="Invalid item";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtDiscount"])){
		$errors["discount"]="Invalid discount";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtTottal"])){
		$errors["tottal"]="Invalid tottal";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtRemark"])){
		$errors["remark"]="Invalid remark";
	}

*/
	if(count($errors)==0){
		$invoice=new Invoice();
		$invoice->id=$_POST["txtId"];
		$invoice->patient_id=$_POST["cmbPatientId"];
		$invoice->doctor_id=$_POST["cmbDoctorId"];
		// $invoice->item=$_POST["txtItem"];
		$invoice->discount=$_POST["txtDiscount"];
		$invoice->total=$_POST["txtTotal"];
		$invoice->remark=$_POST["txtRemark"];
		$invoice->invoice_date=$_POST["cmbinvoicedate"];

		$invoice->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="invoices">Manage Invoice</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-invoice' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$invoice->id"]);
	$html.=select_field(["label"=>"Patient","name"=>"cmbPatientId","table"=>"patients","value"=>"$invoice->patient_id"]);
	$html.=select_field(["label"=>"Doctor","name"=>"cmbDoctorId","table"=>"doctors","value"=>"$invoice->doctor_id"]);
	// $html.=input_field(["label"=>"Item","type"=>"text","name"=>"txtItem","value"=>"$invoice->item"]);
	$html.=input_field(["label"=>"Discount","type"=>"text","name"=>"txtDiscount","value"=>"$invoice->discount"]);
	$html.=input_field(["label"=>"Tottal","type"=>"text","name"=>"txtTotal","value"=>"$invoice->total"]);
	$html.=input_field(["label"=>"Remark","type"=>"text","name"=>"txtRemark","value"=>"$invoice->remark"]);
	$html.=input_field(["label"=>"Date","type"=>"text","name"=>"cmbinvoicedate","value"=>"$invoice->invoice_date"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
