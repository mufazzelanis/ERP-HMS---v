<?php
class PrescriptionApi{
	public function __construct(){
	}
	function save($data){

		
		$prescription=new Prescription();

		
		$prescription->patient_id=$data["patient_id"];
		$prescription->doctor_id=$data["doctor_id"];
		$prescription->appointment_id=$data["appointment_id"];
		$prescription->history=$data["history"];
		$prescription->advice=$data["advice"];
		$prescription->note=$data["note"];
		

		$prescription_id=$prescription->save(); 
		// $prescription->save();
		
		foreach($PresmedicineDetail as $patient){

		$presmedicinedetail=new PresmedicineDetail();

		$presmedicinedetail->prescription_id=$prescription_id;
		$presmedicinedetail->medicine_id=$patient["medicine_id"];
		$presmedicinedetail->dosage=$patient["dosage"];
		$presmedicinedetail->days=$patient["days"];
		$presmedicinedetail->instructions=$patient["instructions"];

		$presmedicinedetail->save();
		

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
		$prescription->follow_up=$data["follow_up"];
		$prescription->p_weight=$data["p_weight"];
		$prescription->temperature=$data["temperature"];
		$prescription->blood_pressure=$data["blood_pressure"];
		$prescription->spo2=$data["spo2"];
		$prescription->heart_rate=$data["heart_rate"];
		$prescription->cc=$data["cc"];

		$prescription->update();
		echo json_encode(["success" => "yes"]);
	}
}
}

?>
