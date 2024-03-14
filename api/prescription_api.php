<?php
class PrescriptionApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["prescriptions"=>Prescription::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["prescriptions"=>Prescription::pagination($page,$perpage),"total_records"=>Prescription::count()]);
	}
	function find($data){
		echo json_encode(["prescription"=>Prescription::find($data["id"])]);
	}
	function delete($data){
		Prescription::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){

			$now=date("Y-m-d H:i:s");

			$prescription=new Prescription();
			$prescription->patient_id=$data["patient_id"];
			$prescription->doctor_id=$data["doctor_id"];
			$prescription->appointment_id=$data["appointment_id"];
			$prescription->history=$data["history"];
			$prescription->advice=$data["advice"];
			$prescription->note=$data["note"];
			$prescription->prescription_date=$now;

			$prescription_id=$prescription->save();

			$mdetails=$data["insmedicine"];

			foreach($mdetails as $mdetail){
			$presmedicinedetail=new PresmedicineDetail();
			$presmedicinedetail->prescription_id=$prescription_id;
			$presmedicinedetail->medicine_id=$mdetail["medicine_id"];
			$presmedicinedetail->dosage=$mdetail["dose"];
			$presmedicinedetail->days=$mdetail["day"];
			$presmedicinedetail->instructions=$mdetail["instructions"];

			$presmedicinedetail->save();	
								
			}
			echo json_encode(["success" => "yes"]);
		}
	function update($data,$file=[]){
		$prescription=new Prescription();
		$prescription->id=$data["id"];
		$prescription->patient_id=$data["patient_id"];
		$prescription->doctor_id=$data["doctor_id"];
		$prescription->appointment_id=$data["appointment_id"];
		$prescription->history=$data["history"];
		$prescription->advice=$data["advice"];
		$prescription->note=$data["note"];

		$prescription->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
