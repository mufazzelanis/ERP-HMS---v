<?php
class PresmedicineDetailApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["presmedicine_details"=>PresmedicineDetail::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["presmedicine_details"=>PresmedicineDetail::pagination($page,$perpage),"total_records"=>PresmedicineDetail::count()]);
	}
	function find($data){
		echo json_encode(["presmedicinedetail"=>PresmedicineDetail::find($data["id"])]);
	}
	function delete($data){
		PresmedicineDetail::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$presmedicinedetail=new PresmedicineDetail();
		$presmedicinedetail->prescription_id=$data["prescription_id"];
		$presmedicinedetail->medicine_id=$data["medicine_id"];
		$presmedicinedetail->dosage=$data["dosage"];
		$presmedicinedetail->days=$data["days"];
		$presmedicinedetail->instructions=$data["instructions"];

		$presmedicinedetail->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$presmedicinedetail=new PresmedicineDetail();
		$presmedicinedetail->id=$data["id"];
		$presmedicinedetail->prescription_id=$data["prescription_id"];
		$presmedicinedetail->medicine_id=$data["medicine_id"];
		$presmedicinedetail->dosage=$data["dosage"];
		$presmedicinedetail->days=$data["days"];
		$presmedicinedetail->instructions=$data["instructions"];

		$presmedicinedetail->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
