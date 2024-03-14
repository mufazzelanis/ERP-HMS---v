<?php
class SectionApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["sections"=>Section::all()]);
	}
	function find($data){
		echo json_encode(["section"=>Section::find($data["id"])]);
	}
	function delete($data){
		Section::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$section=new Section();
		$section->name=$data["name"];

		$section->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$section=new Section();
		$section->id=$data["id"];
		$section->name=$data["name"];

		$section->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
