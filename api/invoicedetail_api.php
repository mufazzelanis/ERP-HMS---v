<?php
class InvoiceDetailApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["invoice_details"=>InvoiceDetail::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["invoice_details"=>InvoiceDetail::pagination($page,$perpage),"total_records"=>InvoiceDetail::count()]);
	}
	function find($data){
		echo json_encode(["invoicedetail"=>InvoiceDetail::find($data["id"])]);
	}
	function delete($data){
		InvoiceDetail::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$invoicedetail=new InvoiceDetail();
		$invoicedetail->labe_test_id=$data["labe_test_id"];
		$invoicedetail->price=$data["price"];
		$invoicedetail->invoice_id=$data["invoice_id"];

		$invoicedetail->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$invoicedetail=new InvoiceDetail();
		$invoicedetail->id=$data["id"];
		$invoicedetail->labe_test_id=$data["labe_test_id"];
		$invoicedetail->price=$data["price"];
		$invoicedetail->invoice_id=$data["invoice_id"];

		$invoicedetail->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
