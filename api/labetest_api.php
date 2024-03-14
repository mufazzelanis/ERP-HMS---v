<?php
class LabeTestApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["labe_tests"=>LabeTest::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["labe_tests"=>LabeTest::pagination($page,$perpage),"total_records"=>LabeTest::count()]);
	}
	function find($data){
		echo json_encode(["labetest"=>LabeTest::find($data["id"])]);
	}
	function delete($data){
		LabeTest::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$labetest=new LabeTest();
		$labetest->name=$data["name"];
		$labetest->price=$data["price"];

		$labetest->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$labetest=new LabeTest();
		$labetest->id=$data["id"];
		$labetest->name=$data["name"];
		$labetest->price=$data["price"];

		$labetest->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
