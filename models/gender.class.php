<?php
class Gender implements JsonSerializable{
	public $id;
	public $gender;

	public function __construct(){
	}
	public function set($id,$gender){
		$this->id=$id;
		$this->gender=$gender;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}genders(gender)values('$this->gender')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}genders set gender='$this->gender' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}genders where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,gender from {$tx}genders");
		$data=[];
		while($gender=$result->fetch_object()){
			$data[]=$gender;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,gender from {$tx}genders $criteria limit $top,$perpage");
		$data=[];
		while($gender=$result->fetch_object()){
			$data[]=$gender;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}genders $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,gender from {$tx}genders where id='$id'");
		$gender=$result->fetch_object();
			return $gender;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}genders");
		$gender =$result->fetch_object();
		return $gender->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Gender:$this->gender<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbGender"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}genders");
		while($gender=$result->fetch_object()){
			$html.="<option value ='$gender->id'>$gender->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}genders $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,gender from {$tx}genders $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-gender\">New Gender</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Gender</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Gender</th></tr>";
		}
		while($gender=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$gender->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-gender"]);
				$action_buttons.= action_button(["id"=>$gender->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-gender"]);
				$action_buttons.= action_button(["id"=>$gender->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"genders"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$gender->id</td><td>$gender->gender</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,gender from {$tx}genders where id={$id}");
		$gender=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Gender Details</th></tr>";
		$html.="<tr><th>Id</th><td>$gender->id</td></tr>";
		$html.="<tr><th>Gender</th><td>$gender->gender</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
