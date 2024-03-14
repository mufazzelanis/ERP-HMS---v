<?php
class CategoryApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["categories"=>Category::all()]);
	}
	function find($data){
		echo json_encode(["category"=>Category::find($data["id"])]);
	}
	function delete($data){
		Category::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$category=new Category();
		$category->name=$data["name"];
		$category->section_id=$data["section_id"];
		$category->created_at=$data["created_at"];
		$category->updated_at=$data["updated_at"];

		$category->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$category=new Category();
		$category->id=$data["id"];
		$category->name=$data["name"];
		$category->section_id=$data["section_id"];
		$category->created_at=$data["created_at"];
		$category->updated_at=$data["updated_at"];

		$category->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
