<?php
class Schedule implements JsonSerializable{
	public $id;
	public $doctor_id;
	public $weekday_id;
	public $start_time;
	public $end_time;
	public $duration;

	public function __construct(){
	}
	public function set($id,$doctor_id,$weekday_id,$start_time,$end_time,$duration){
		$this->id=$id;
		$this->doctor_id=$doctor_id;
		$this->weekday_id=$weekday_id;
		$this->start_time=$start_time;
		$this->end_time=$end_time;
		$this->duration=$duration;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}schedules(doctor_id,weekday_id,start_time,end_time,duration)values('$this->doctor_id','$this->weekday_id','$this->start_time','$this->end_time','$this->duration')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}schedules set doctor_id='$this->doctor_id',weekday_id='$this->weekday_id',start_time='$this->start_time',end_time='$this->end_time',duration='$this->duration' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}schedules where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,doctor_id,weekday_id,start_time,end_time,duration from {$tx}schedules");
		$data=[];
		while($schedule=$result->fetch_object()){
			$data[]=$schedule;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,doctor_id,weekday_id,start_time,end_time,duration from {$tx}schedules $criteria limit $top,$perpage");
		$data=[];
		while($schedule=$result->fetch_object()){
			$data[]=$schedule;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}schedules $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,doctor_id,weekday_id,start_time,end_time,duration from {$tx}schedules where id='$id'");
		$schedule=$result->fetch_object();
			return $schedule;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}schedules");
		$schedule =$result->fetch_object();
		return $schedule->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Doctor Id:$this->doctor_id<br> 
		Weekday Id:$this->weekday_id<br> 
		Start Time:$this->start_time<br> 
		End Time:$this->end_time<br> 
		Duration:$this->duration<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbSchedule"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}schedules");
		while($schedule=$result->fetch_object()){
			$html.="<option value ='$schedule->id'>$schedule->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}schedules $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("SELECT s.id,d.name doctor,wd.name weekday,s.start_time,s.end_time,s.duration FROM {$tx}schedules s JOIN {$tx}doctors d ON s.doctor_id = d.id JOIN {$tx}weekdays wd ON s.weekday_id = wd.id $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-schedule\">New Schedule</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Doctor Name</th><th>Weekday</th><th>Start Time</th><th>End Time</th><th>Duration</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Doctor</th><th>Weekday</th><th>Start Time</th><th>End Time</th><th>Duration</th></tr>";
		}
		while($schedule=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button_icon(["id"=>$schedule->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-schedule"],"fas fa-info-circle");
				$action_buttons.= action_button_icon(["id"=>$schedule->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-schedule"],"fas fa-edit");
				$action_buttons.= action_button_icon(["id"=>$schedule->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"schedules"],"fas fa-trash-alt");
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$schedule->id</td><td>$schedule->doctor</td><td>$schedule->weekday</td><td>$schedule->start_time</td><td>$schedule->end_time</td><td>$schedule->duration</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,doctor_id,weekday_id,start_time,end_time,duration from {$tx}schedules where id={$id}");
		$schedule=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Schedule Details</th></tr>";
		$html.="<tr><th>Id</th><td>$schedule->id</td></tr>";
		$html.="<tr><th>Doctor Id</th><td>$schedule->doctor_id</td></tr>";
		$html.="<tr><th>Weekday Id</th><td>$schedule->weekday_id</td></tr>";
		$html.="<tr><th>Start Time</th><td>$schedule->start_time</td></tr>";
		$html.="<tr><th>End Time</th><td>$schedule->end_time</td></tr>";
		$html.="<tr><th>Duration</th><td>$schedule->duration</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
