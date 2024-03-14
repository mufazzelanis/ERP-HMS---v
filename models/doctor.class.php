<?php
class Doctor implements JsonSerializable{
	public $id;
	public $name;
	public $department_id;
	public $phone_number;
	public $address;
	public $designation;
	public $email;
	public $fees;
	public $available_appointments;

	public function __construct(){
	}
	public function set($id,$name,$department_id,$phone_number,$address,$designation,$email,$fees,$available_appointments){
		$this->id=$id;
		$this->name=$name;
		$this->department_id=$department_id;
		$this->phone_number=$phone_number;
		$this->address=$address;
		$this->designation=$designation;
		$this->email=$email;
		$this->fees=$fees;
		$this->available_appointments=$available_appointments;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}doctors(name,department_id,phone_number,address,designation,email,fees,available_appointments)values('$this->name','$this->department_id','$this->phone_number','$this->address','$this->designation','$this->email','$this->fees','$this->available_appointments')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}doctors set name='$this->name',department_id='$this->department_id',phone_number='$this->phone_number',address='$this->address',designation='$this->designation',email='$this->email',fees='$this->fees',available_appointments='$this->available_appointments' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}doctors where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,department_id,phone_number,address,designation,email,fees,available_appointments from {$tx}doctors");
		$data=[];
		while($doctor=$result->fetch_object()){
			$data[]=$doctor;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,department_id,phone_number,address,designation,email,fees,available_appointments from {$tx}doctors $criteria limit $top,$perpage");
		$data=[];
		while($doctor=$result->fetch_object()){
			$data[]=$doctor;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}doctors $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,department_id,phone_number,address,designation,email,fees,available_appointments from {$tx}doctors where id='$id'");
		$doctor=$result->fetch_object();
			return $doctor;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}doctors");
		$doctor =$result->fetch_object();
		return $doctor->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Department Id:$this->department_id<br> 
		Phone Number:$this->phone_number<br> 
		Address:$this->address<br> 
		Designation:$this->designation<br> 
		Email:$this->email<br> 
		Fees:$this->fees<br> 
		Available Appointments:$this->available_appointments<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbDoctor"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}doctors");
		while($doctor=$result->fetch_object()){
			$html.="<option value ='$doctor->id'>$doctor->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}doctors $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select d.id,d.name,cd.name departments,d.phone_number,d.address,d.designation,d.email,d.schedule,d.fees,d.available_appointments from core_doctors d,core_departments cd where d.department_id=cd.id $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-info\" href=\"create-doctor\">New Doctor</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Doctor Name</th><th>Department Name</th><th>Mobile Number</th><th>Location</th><th>Designation</th><th>Email Address</th><th>Appointment Fee</th><th>Available Appoint</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Department Id</th><th>Phone Number</th><th>Address</th><th>Designation</th><th>Email</th><th>Fees</th><th>Available Appointments</th></tr>";
		}
		while($doctor=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button_icon(["id"=>$doctor->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-doctor"],"fas fa-info-circle");
				$action_buttons.= action_button_icon(["id"=>$doctor->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-doctor"],"fas fa-edit");
				$action_buttons.= action_button_icon(["id"=>$doctor->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"doctors"],"fas fa-trash-alt");
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$doctor->id</td><td>$doctor->name</td><td>$doctor->departments</td><td>$doctor->phone_number</td><td>$doctor->address</td><td>$doctor->designation</td><td>$doctor->email</td><td>$doctor->fees</td><td>$doctor->available_appointments</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,name,department_id,phone_number,address,designation,email,fees,available_appointments from {$tx}doctors where id={$id}");
		$doctor=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Doctor Details</th></tr>";
		$html.="<tr><th>Id</th><td>$doctor->id</td></tr>";
		$html.="<tr><th>Name</th><td>$doctor->name</td></tr>";
		$html.="<tr><th>Department Id</th><td>$doctor->department_id</td></tr>";
		$html.="<tr><th>Phone Number</th><td>$doctor->phone_number</td></tr>";
		$html.="<tr><th>Address</th><td>$doctor->address</td></tr>";
		$html.="<tr><th>Designation</th><td>$doctor->designation</td></tr>";
		$html.="<tr><th>Email</th><td>$doctor->email</td></tr>";
		$html.="<tr><th>Fees</th><td>$doctor->fees</td></tr>";
		$html.="<tr><th>Available Appointments</th><td>$doctor->available_appointments</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
