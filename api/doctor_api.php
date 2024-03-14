<?php
class DoctorApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["doctors"=>Doctor::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["doctors"=>Doctor::pagination($page,$perpage),"total_records"=>Doctor::count()]);
	}
	function find($data){
		echo json_encode(["doctor"=>Doctor::find($data["id"])]);
	}
	function delete($data){
		Doctor::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$doctor=new Doctor();
		$doctor->name=$data["name"];
		$doctor->department_id=$data["department_id"];
		$doctor->phone_number=$data["phone_number"];
		$doctor->address=$data["address"];
		$doctor->designation=$data["designation"];
		$doctor->email=$data["email"];
		$doctor->schedule=$data["schedule"];
		$doctor->available_appointments=$data["available_appointments"];

		$doctor->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$doctor=new Doctor();
		$doctor->id=$data["id"];
		$doctor->name=$data["name"];
		$doctor->department_id=$data["department_id"];
		$doctor->phone_number=$data["phone_number"];
		$doctor->address=$data["address"];
		$doctor->designation=$data["designation"];
		$doctor->email=$data["email"];
		$doctor->schedule=$data["schedule"];
		$doctor->available_appointments=$data["available_appointments"];

		$doctor->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
