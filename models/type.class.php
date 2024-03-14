<?php
class Type implements JsonSerializable{
	public $id;
	public $name;

	public function __construct(){
	}
	public function set($id,$name){
		$this->id=$id;
		$this->name=$name;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}types(name)values('$this->name')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}types set name='$this->name' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}types where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name from {$tx}types");
		$data=[];
		while($type=$result->fetch_object()){
			$data[]=$type;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name from {$tx}types $criteria limit $top,$perpage");
		$data=[];
		while($type=$result->fetch_object()){
			$data[]=$type;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}types $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name from {$tx}types where id='$id'");
		$type=$result->fetch_object();
			return $type;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}types");
		$type =$result->fetch_object();
		return $type->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbType"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}types");
		while($type=$result->fetch_object()){
			$html.="<option value ='$type->id'>$type->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}types $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name from {$tx}types $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-type\">New Type</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th></tr>";
		}
		while($type=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$type->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-type"]);
				$action_buttons.= action_button(["id"=>$type->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-type"]);
				$action_buttons.= action_button(["id"=>$type->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"types"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$type->id</td><td>$type->name</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,name from {$tx}types where id={$id}");
		$type=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Type Details</th></tr>";
		$html.="<tr><th>Id</th><td>$type->id</td></tr>";
		$html.="<tr><th>Name</th><td>$type->name</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
