<?php
class CustomerApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["customers"=>Customer::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["customers"=>Customer::pagination($page,$perpage),"total_records"=>Customer::count()]);
	}
	function find($data){
		echo json_encode(["customer"=>Customer::find($data["id"])]);
	}
	function delete($data){
		Customer::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$customer=new Customer();
		$customer->id=$data["id"];
		$customer->name=$data["name"];
		$customer->mobile=$data["mobile"];
		$customer->email=$data["email"];

		$customer->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$customer=new Customer();
		$customer->id=$data["id"];
		$customer->id=$data["id"];
		$customer->name=$data["name"];
		$customer->mobile=$data["mobile"];
		$customer->email=$data["email"];

		$customer->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
