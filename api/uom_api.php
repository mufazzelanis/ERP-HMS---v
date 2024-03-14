<?php
class UomApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["uom"=>Uom::all()]);
	}
	function find($data){
		echo json_encode(["uom"=>Uom::find($data["id"])]);
	}
	function delete($data){
		Uom::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$uom=new Uom();
		$uom->name=$data["name"];

		$uom->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$uom=new Uom();
		$uom->id=$data["id"];
		$uom->name=$data["name"];

		$uom->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
