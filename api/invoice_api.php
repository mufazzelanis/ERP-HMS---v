<?php
class InvoiceApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["invoices"=>Invoice::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["invoices"=>Invoice::pagination($page,$perpage),"total_records"=>Invoice::count()]);
	}
	function find($data){
		echo json_encode(["invoice"=>Invoice::find($data["id"])]);
	}
	function delete($data){
		Invoice::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		
		$now=date("Y-m-d H:i:s");
		
		$invoice=new Invoice();

		$invoice->patient_id=$data["patient_id"];
		$invoice->doctor_id=$data["doctor_id"];
		// $invoice->item=$data["item"];
		$invoice->discount=$data["discount"];
		$invoice->total=$data["total"];
		$invoice->remark=$data["remark"];
		$invoice->invoice_date=$now;

		$invoice_id= $invoice->save();

		$mdinvoice=$data["InvoiceDetail"];

		foreach($mdinvoice as $mdinvoice){

		$invoicedetail=new InvoiceDetail();
		$invoicedetail->invoice_id=$invoice_id;
		$invoicedetail->labe_test_id=$mdinvoice["labe_test_id"];
		$invoicedetail->price=$mdinvoice["price"];
		// $invoicedetail->invoice_id=$mdinvoice["invoice_id"];

		$invoicedetail->save();
		}

		echo json_encode(["success" => "yes"]);
	}

	function update($data,$file=[]){
		$invoice=new Invoice();
		$invoice->id=$data["id"];
		$invoice->patient_id=$data["patient_id"];
		$invoice->doctor_id=$data["doctor_id"];
		// $invoice->item=$data["item"];
		$invoice->discount=$data["discount"];
		$invoice->total=$data["total"];
		$invoice->remark=$data["remark"];
		$invoice->invoice_date=$now;

		$invoice->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
