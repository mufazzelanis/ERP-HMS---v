<?php
class Uom implements JsonSerializable{
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
		$db->query("insert into {$tx}uoms(name)values('$this->name')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}uoms set name='$this->name' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}uoms where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name from {$tx}uoms");
		$data=[];
		while($uom=$result->fetch_object()){
			$data[]=$uom;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name from {$tx}uoms $criteria limit $top,$perpage");
		$data=[];
		while($uom=$result->fetch_object()){
			$data[]=$uom;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}uoms $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name from {$tx}uoms where id='$id'");
		$uom=$result->fetch_object();
			return $uom;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}uoms");
		$uom =$result->fetch_object();
		return $uom->last_id;
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

	static function html_select($name="cmbUom"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}uoms");
		while($uom=$result->fetch_object()){
			$html.="<option value ='$uom->id'>$uom->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}uoms $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name from {$tx}uoms $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-uom\">New Uom</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th></tr>";
		}
		while($uom=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$uom->id, "name"=>"Details", "value"=>"Detials", "class"=>"info", "url"=>"details-uom"]);
				$action_buttons.= action_button(["id"=>$uom->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-uom"]);
				$action_buttons.= action_button(["id"=>$uom->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"uoms"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$uom->id</td><td>$uom->name</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,name from {$tx}uoms where id={$id}");
		$uom=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Uom Details</th></tr>";
		$html.="<tr><th>Id</th><td>$uom->id</td></tr>";
		$html.="<tr><th>Name</th><td>$uom->name</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
