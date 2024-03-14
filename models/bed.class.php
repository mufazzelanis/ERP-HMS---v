<?php
class Bed implements JsonSerializable{
	public $id;
	public $name;
	public $category_id;
	public $room_id;
	public $status_id;

	public function __construct(){
	}
	public function set($id,$name,$category_id,$room_id,$status_id){
		$this->id=$id;
		$this->name=$name;
		$this->category_id=$category_id;
		$this->room_id=$room_id;
		$this->status_id=$status_id;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}beds(name,category_id,room_id,status_id)values('$this->name','$this->category_id','$this->room_id','$this->status_id')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}beds set name='$this->name',category_id='$this->category_id',room_id='$this->room_id',status_id='$this->status_id' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}beds where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,category_id,room_id,status_id from {$tx}beds");
		$data=[];
		while($bed=$result->fetch_object()){
			$data[]=$bed;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,category_id,room_id,status_id from {$tx}beds $criteria limit $top,$perpage");
		$data=[];
		while($bed=$result->fetch_object()){
			$data[]=$bed;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}beds $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,category_id,room_id,status_id from {$tx}beds where id='$id'");
		$bed=$result->fetch_object();
			return $bed;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}beds");
		$bed =$result->fetch_object();
		return $bed->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Category Id:$this->category_id<br> 
		Room Id:$this->room_id<br> 
		Status Id:$this->status_id<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbBed"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}beds");
		while($bed=$result->fetch_object()){
			$html.="<option value ='$bed->id'>$bed->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}beds $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,category_id,room_id,status_id from {$tx}beds $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-info\" href=\"create-bed\">New Bed</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Bed Name</th><th>Bed Category</th><th>Room No</th><th>Room Status</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Category Id</th><th>Room Id</th><th>Status Id</th></tr>";
		}
		while($bed=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button_icon(["id"=>$bed->id, "name"=>"Details", "value"=>"Details", "class"=>"success", "url"=>"details-bed"],"fas fa-info-circle");
				$action_buttons.= action_button_icon(["id"=>$bed->id, "name"=>"Edit", "value"=>"Edit", "class"=>"info", "url"=>"edit-bed"],"fas fa-edit");
				$action_buttons.= action_button_icon(["id"=>$bed->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"beds"],"fas fa-trash-alt");
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$bed->id</td><td>$bed->name</td><td>$bed->category_id</td><td>$bed->room_id</td><td>$bed->status_id</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,name,category_id,room_id,status_id from {$tx}beds where id={$id}");
		$bed=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Bed Details</th></tr>";
		$html.="<tr><th>Id</th><td>$bed->id</td></tr>";
		$html.="<tr><th>Name</th><td>$bed->name</td></tr>";
		$html.="<tr><th>Category Id</th><td>$bed->category_id</td></tr>";
		$html.="<tr><th>Room Id</th><td>$bed->room_id</td></tr>";
		$html.="<tr><th>Status Id</th><td>$bed->status_id</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
