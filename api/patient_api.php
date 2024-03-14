<?php
class PatientApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["patients"=>Patient::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["patients"=>Patient::pagination($page,$perpage),"total_records"=>Patient::count()]);
	}
	function find($data){
		echo json_encode(["patient"=>Patient::find($data["id"])]);
	}
	function delete($data){
		Patient::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$patient=new Patient();
		$patient->name=$data["name"];
		$patient->groups_id=$data["groups_id"];
		$patient->gender_id=$data["gender_id"];
		$patient->address=$data["address"];
		$patient->contact_number=$data["contact_number"];
		$patient->email=$data["email"];
		$patient->employer=$data["employer"];
		$patient->insurance_info=$data["insurance_info"];
		$patient->type_id=$data["type_id"];
		$patient->doctor_id=$data["doctor_id"];
		$patient->photo=upload($file["photo"], "../img",$data["name"]);

		$patient->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$patient=new Patient();
		$patient->id=$data["id"];
		$patient->name=$data["name"];
		$patient->groups_id=$data["groups_id"];
		$patient->gender_id=$data["gender_id"];
		$patient->address=$data["address"];
		$patient->contact_number=$data["contact_number"];
		$patient->email=$data["email"];
		$patient->employer=$data["employer"];
		$patient->insurance_info=$data["insurance_info"];
		$patient->type_id=$data["type_id"];
		$patient->doctor_id=$data["doctor_id"];
		if(isset($file["photo"]["name"])){
			$patient->photo=upload($file["photo"], "../img",$data["name"]);
		}else{
			$patient->photo=Patient::find($data["id"])->photo;
		}
		$patient->updated_at=$now;

		$patient->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
