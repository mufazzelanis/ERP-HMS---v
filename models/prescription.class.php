<?php
class Prescription implements JsonSerializable{
	public $id;
	public $patient_id;
	public $doctor_id;
	public $appointment_id;
	public $prescription_date;
	public $history;
	public $advice;
	public $note;

	public function __construct(){
	}
	public function set($id,$patient_id,$doctor_id,$appointment_id,$prescription_date,$history,$advice,$note){
		$this->id=$id;
		$this->patient_id=$patient_id;
		$this->doctor_id=$doctor_id;
		$this->appointment_id=$appointment_id;
		$this->prescription_date=$prescription_date;
		$this->history=$history;
		$this->advice=$advice;
		$this->note=$note;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}prescriptions(patient_id,doctor_id,appointment_id,prescription_date,history,advice,note)values('$this->patient_id','$this->doctor_id','$this->appointment_id','$this->prescription_date','$this->history','$this->advice','$this->note')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}prescriptions set patient_id='$this->patient_id',doctor_id='$this->doctor_id',appointment_id='$this->appointment_id',prescription_date='$this->prescription_date',history='$this->history',advice='$this->advice',note='$this->note' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}prescriptions where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,patient_id,doctor_id,appointment_id,prescription_date,history,advice,note from {$tx}prescriptions");
		$data=[];
		while($prescription=$result->fetch_object()){
			$data[]=$prescription;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,patient_id,doctor_id,appointment_id,prescription_date,history,advice,note from {$tx}prescriptions $criteria limit $top,$perpage");
		$data=[];
		while($prescription=$result->fetch_object()){
			$data[]=$prescription;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}prescriptions $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,patient_id,doctor_id,appointment_id,prescription_date,history,advice,note from {$tx}prescriptions where id='$id'");
		$prescription=$result->fetch_object();
			return $prescription;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}prescriptions");
		$prescription =$result->fetch_object();
		return $prescription->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Patient Id:$this->patient_id<br> 
		Doctor Id:$this->doctor_id<br> 
		Appointment Id:$this->appointment_id<br> 
		Prescription Date:$this->prescription_date<br> 
		History:$this->history<br> 
		Advice:$this->advice<br> 
		Note:$this->note<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbPrescription"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}prescriptions");
		while($prescription=$result->fetch_object()){
			$html.="<option value ='$prescription->id'>$prescription->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}prescriptions $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("SELECT p.id,pa.name patient,d.name doctor,p.prescription_date,p.history,p.advice,p.note from {$tx}prescriptions p, {$tx}patients pa, {$tx}doctors d where pa.id=p.patient_id and d.id=p.doctor_id $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-prescription\">New Prescription</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Patient Name</th><th>Doctor Name</th><th>Prescription Date</th><th>History</th><th>Advice</th><th>Note</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Patient Name</th><th>Doctor Name</th><th>Prescription Date</th><th>History</th><th>Advice</th><th>Note</th></tr>";
		}
		while($prescription=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button_icon(["id"=>$prescription->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-prescription"],"fas fa-info-circle");
				$action_buttons.= action_button_icon(["id"=>$prescription->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-prescription"],"fas fa-edit");
				$action_buttons.= action_button_icon(["id"=>$prescription->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"prescriptions"],"fas fa-trash-alt");
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$prescription->id</td><td>$prescription->patient</td><td>$prescription->doctor</td><td>$prescription->prescription_date</td><td>$prescription->history</td><td>$prescription->advice</td><td>$prescription->note</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,patient_id,doctor_id,appointment_id,prescription_date,history,advice,note from {$tx}prescriptions where id={$id}");
		$prescription=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Prescription Details</th></tr>";
		$html.="<tr><th>Id</th><td>$prescription->id</td></tr>";
		$html.="<tr><th>Patient Id</th><td>$prescription->patient_id</td></tr>";
		$html.="<tr><th>Doctor Id</th><td>$prescription->doctor_id</td></tr>";
		$html.="<tr><th>Appointment Id</th><td>$prescription->appointment_id</td></tr>";
		$html.="<tr><th>Prescription Date</th><td>$prescription->prescription_date</td></tr>";
		$html.="<tr><th>History</th><td>$prescription->history</td></tr>";
		$html.="<tr><th>Advice</th><td>$prescription->advice</td></tr>";
		$html.="<tr><th>Note</th><td>$prescription->note</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
