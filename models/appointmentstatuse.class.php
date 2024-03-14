<?php
class AppointmentStatuse implements JsonSerializable{
	public $id;
	public $appointment_status;

	public function __construct(){
	}
	public function set($id,$appointment_status){
		$this->id=$id;
		$this->appointment_status=$appointment_status;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}appointment_statuses(appointment_status)values('$this->appointment_status')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}appointment_statuses set appointment_status='$this->appointment_status' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}appointment_statuses where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,appointment_status from {$tx}appointment_statuses");
		$data=[];
		while($appointmentstatuse=$result->fetch_object()){
			$data[]=$appointmentstatuse;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,appointment_status from {$tx}appointment_statuses $criteria limit $top,$perpage");
		$data=[];
		while($appointmentstatuse=$result->fetch_object()){
			$data[]=$appointmentstatuse;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}appointment_statuses $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,appointment_status from {$tx}appointment_statuses where id='$id'");
		$appointmentstatuse=$result->fetch_object();
			return $appointmentstatuse;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}appointment_statuses");
		$appointmentstatuse =$result->fetch_object();
		return $appointmentstatuse->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Appointment Status:$this->appointment_status<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbAppointmentStatuse"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}appointment_statuses");
		while($appointmentstatuse=$result->fetch_object()){
			$html.="<option value ='$appointmentstatuse->id'>$appointmentstatuse->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}appointment_statuses $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,appointment_status from {$tx}appointment_statuses $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-appointmentstatuse\">New AppointmentStatuse</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Appointment Status</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Appointment Status</th></tr>";
		}
		while($appointmentstatuse=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$appointmentstatuse->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-appointmentstatuse"]);
				$action_buttons.= action_button(["id"=>$appointmentstatuse->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-appointmentstatuse"]);
				$action_buttons.= action_button(["id"=>$appointmentstatuse->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"appointment_statuses"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$appointmentstatuse->id</td><td>$appointmentstatuse->appointment_status</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,appointment_status from {$tx}appointment_statuses where id={$id}");
		$appointmentstatuse=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">AppointmentStatuse Details</th></tr>";
		$html.="<tr><th>Id</th><td>$appointmentstatuse->id</td></tr>";
		$html.="<tr><th>Appointment Status</th><td>$appointmentstatuse->appointment_status</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
