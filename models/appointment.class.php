<?php
class Appointment implements JsonSerializable{
	public $id;
	public $patient_id;
	public $doctor_id;
	public $appointment_date;
	public $appointment_time;
	public $created_at;
	public $updated_at;
	public $appointment_statuses_id;

	public function __construct(){
	}
	public function set($id,$patient_id,$doctor_id,$appointment_date,$appointment_time,$created_at,$updated_at,$appointment_statuses_id){
		$this->id=$id;
		$this->patient_id=$patient_id;
		$this->doctor_id=$doctor_id;
		$this->appointment_date=$appointment_date;
		$this->appointment_time=$appointment_time;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;
		$this->appointment_statuses_id=$appointment_statuses_id;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}appointments(patient_id,doctor_id,appointment_date,appointment_time,created_at,updated_at,appointment_statuses_id)values('$this->patient_id','$this->doctor_id','$this->appointment_date','$this->appointment_time','$this->created_at','$this->updated_at','$this->appointment_statuses_id')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}appointments set patient_id='$this->patient_id',doctor_id='$this->doctor_id',appointment_date='$this->appointment_date',appointment_time='$this->appointment_time',created_at='$this->created_at',updated_at='$this->updated_at',appointment_statuses_id='$this->appointment_statuses_id' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}appointments where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,patient_id,doctor_id,appointment_date,appointment_time,created_at,updated_at,appointment_statuses_id from {$tx}appointments");
		$data=[];
		while($appointment=$result->fetch_object()){
			$data[]=$appointment;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,patient_id,doctor_id,appointment_date,appointment_time,created_at,updated_at,appointment_statuses_id from {$tx}appointments $criteria limit $top,$perpage");
		$data=[];
		while($appointment=$result->fetch_object()){
			$data[]=$appointment;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}appointments $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,patient_id,doctor_id,appointment_date,appointment_time,created_at,updated_at,appointment_statuses_id from {$tx}appointments where id='$id'");
		$appointment=$result->fetch_object();
			return $appointment;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}appointments");
		$appointment =$result->fetch_object();
		return $appointment->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Patient Id:$this->patient_id<br> 
		Doctor Id:$this->doctor_id<br> 
		Appointment Date:$this->appointment_date<br> 
		Appointment Time:$this->appointment_time<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
		Appointment Statuses Id:$this->appointment_statuses_id<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbAppointment"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}appointments");
		while($appointment=$result->fetch_object()){
			$html.="<option value ='$appointment->id'>$appointment->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}appointments $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select a.id,p.name patient,d.name doctor,a.appointment_date,a.appointment_time,ast.name status,a.created_at from {$tx}appointments a, {$tx}patients p,{$tx}doctors d,{$tx}appointment_statuses ast where a.patient_id=p.id and a.doctor_id=d.id and a.appointment_statuses_id=ast.id $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-info\" href=\"create-appointment\">New Appointment</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Patient Name</th><th>Doctor Name</th><th>Scheduled Date</th><th>Scheduled Time</th><th>Created At</th><th>Appointment Status</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Patient Id</th><th>Doctor Id</th><th>Appointment Date</th><th>Appointment Time</th><th>Created At</th><th>Appointment Statuses Id</th></tr>";
		}
		while($appointment=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button_icon(["id"=>$appointment->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-appointment"],"fas fa-info-circle");
				$action_buttons.= action_button_icon(["id"=>$appointment->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-appointment"],"fas fa-edit");
				$action_buttons.= action_button_icon(["id"=>$appointment->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"appointments"],"fas fa-trash-alt");
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$appointment->id</td><td>$appointment->patient</td><td>$appointment->doctor</td><td>$appointment->appointment_date</td><td>$appointment->appointment_time</td><td>$appointment->created_at</td><td>$appointment->status</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,patient_id,doctor_id,appointment_date,appointment_time,created_at,updated_at,appointment_statuses_id from {$tx}appointments where id={$id}");
		$appointment=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Appointment Details</th></tr>";
		$html.="<tr><th>Id</th><td>$appointment->id</td></tr>";
		$html.="<tr><th>Patient Id</th><td>$appointment->patient_id</td></tr>";
		$html.="<tr><th>Doctor Id</th><td>$appointment->doctor_id</td></tr>";
		$html.="<tr><th>Appointment Date</th><td>$appointment->appointment_date</td></tr>";
		$html.="<tr><th>Appointment Time</th><td>$appointment->appointment_time</td></tr>";
		$html.="<tr><th>Created At</th><td>$appointment->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$appointment->updated_at</td></tr>";
		$html.="<tr><th>Appointment Statuses Id</th><td>$appointment->appointment_statuses_id</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>

