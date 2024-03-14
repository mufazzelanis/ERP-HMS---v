<?php
class Patient implements JsonSerializable{
	public $id;
	public $name;
	public $dob;
	public $groups_id;
	public $gender_id;
	public $address;
	public $contact_number;
	public $email;
	public $employer;
	public $insurance_info;
	public $type_id;
	public $doctor_id;
	public $photo;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$name,$dob,$groups_id,$gender_id,$address,$contact_number,$email,$employer,$insurance_info,$type_id,$doctor_id,$photo,$created_at,$updated_at){
		$this->id=$id;
		$this->name=$name;
		$this->dob=$dob;
		$this->groups_id=$groups_id;
		$this->gender_id=$gender_id;
		$this->address=$address;
		$this->contact_number=$contact_number;
		$this->email=$email;
		$this->employer=$employer;
		$this->insurance_info=$insurance_info;
		$this->type_id=$type_id;
		$this->doctor_id=$doctor_id;
		$this->photo=$photo;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}patients(name,dob,groups_id,gender_id,address,contact_number,email,employer,insurance_info,type_id,doctor_id,photo,created_at,updated_at)values('$this->name','$this->dob','$this->groups_id','$this->gender_id','$this->address','$this->contact_number','$this->email','$this->employer','$this->insurance_info','$this->type_id','$this->doctor_id','$this->photo','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}patients set name='$this->name',dob='$this->dob',groups_id='$this->groups_id',gender_id='$this->gender_id',address='$this->address',contact_number='$this->contact_number',email='$this->email',employer='$this->employer',insurance_info='$this->insurance_info',type_id='$this->type_id',doctor_id='$this->doctor_id',photo='$this->photo',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}patients where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,dob,groups_id,gender_id,address,contact_number,email,employer,insurance_info,type_id,doctor_id,photo,created_at,updated_at from {$tx}patients");
		$data=[];
		while($patient=$result->fetch_object()){
			$data[]=$patient;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,dob,groups_id,gender_id,address,contact_number,email,employer,insurance_info,type_id,doctor_id,photo,created_at,updated_at from {$tx}patients $criteria limit $top,$perpage");
		$data=[];
		while($patient=$result->fetch_object()){
			$data[]=$patient;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}patients $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,dob,groups_id,gender_id,address,contact_number,email,employer,insurance_info,type_id,doctor_id,photo,created_at,updated_at from {$tx}patients where id='$id'");
		$patient=$result->fetch_object();
			return $patient;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}patients");
		$patient =$result->fetch_object();
		return $patient->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Dob:$this->dob<br> 
		Groups Id:$this->groups_id<br> 
		Gender Id:$this->gender_id<br> 
		Address:$this->address<br> 
		Contact Number:$this->contact_number<br> 
		Email:$this->email<br> 
		Employer:$this->employer<br> 
		Insurance Info:$this->insurance_info<br> 
		Type Id:$this->type_id<br> 
		Doctor Id:$this->doctor_id<br> 
		Photo:$this->photo<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbPatient"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}patients");
		while($patient=$result->fetch_object()){
			$html.="<option value ='$patient->id'>$patient->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}patients $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select p.id,p.name,p.dob,g.name blood_group,gen.name gender,p.address,p.contact_number,p.email,p.employer,p.insurance_info,t.name patient_type,d.name doctor,p.photo,p.created_at,p.updated_at FROM {$tx}patients p,{$tx}groups g,{$tx}genders gen,{$tx}types t,{$tx}doctors d WHERE p.groups_id=g.id AND p.gender_id=gen.id AND p.type_id=t.id AND p.doctor_id=d.id $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-info\" href=\"create-patient\">New Patient</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Patient Name</th><th>Date of Birth</th><th>Blood Group</th><th>Sex</th><th>Location</th><th>Mobile Number</th><th>Email Address</th><th>Designation</th><th>Insurance Info</th><th>Patient Type</th><th>Appointment Doctor</th><th>Photo</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Patient</th><th>Dob</th><th>Groups Id</th><th>Gender</th><th>Address</th><th>Contact Number</th><th>Email</th><th>Employer</th><th>Insurance Info</th><th>Patient Type</th><th>Doctor</th><th>Photo</th><th>Created At</th></tr>";
		}
		while($patient=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button_icon(["id"=>$patient->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-patient"],"fas fa-info-circle");
				$action_buttons.= action_button_icon(["id"=>$patient->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-patient"],"fas fa-edit");
				$action_buttons.= action_button_icon(["id"=>$patient->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"patients"],"fas fa-trash-alt");
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$patient->id</td><td>$patient->name</td><td>$patient->dob</td><td>$patient->blood_group</td><td>$patient->gender</td><td>$patient->address</td><td>$patient->contact_number</td><td>$patient->email</td><td>$patient->employer</td><td>$patient->insurance_info</td><td>$patient->patient_type</td><td>$patient->doctor</td><td><img src='img/$patient->photo' width='100' /></td><td>$patient->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,name,dob,groups_id,gender_id,address,contact_number,email,employer,insurance_info,type_id,doctor_id,photo,created_at,updated_at from {$tx}patients where id={$id}");
		$patient=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Patient Details</th></tr>";
		$html.="<tr><th>Id</th><td>$patient->id</td></tr>";
		$html.="<tr><th>Name</th><td>$patient->name</td></tr>";
		$html.="<tr><th>Dob</th><td>$patient->dob</td></tr>";
		$html.="<tr><th>Groups Id</th><td>$patient->groups_id</td></tr>";
		$html.="<tr><th>Gender Id</th><td>$patient->gender_id</td></tr>";
		$html.="<tr><th>Address</th><td>$patient->address</td></tr>";
		$html.="<tr><th>Contact Number</th><td>$patient->contact_number</td></tr>";
		$html.="<tr><th>Email</th><td>$patient->email</td></tr>";
		$html.="<tr><th>Employer</th><td>$patient->employer</td></tr>";
		$html.="<tr><th>Insurance Info</th><td>$patient->insurance_info</td></tr>";
		$html.="<tr><th>Type Id</th><td>$patient->type_id</td></tr>";
		$html.="<tr><th>Doctor Id</th><td>$patient->doctor_id</td></tr>";
		$html.="<tr><th>Photo</th><td><img src='img/$patient->photo' width='100' /></td></tr>";
		$html.="<tr><th>Created At</th><td>$patient->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$patient->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
