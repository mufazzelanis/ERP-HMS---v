<?php
class MedicineCategory implements JsonSerializable{
	public $id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$name,$description,$created_at,$updated_at){
		$this->id=$id;
		$this->name=$name;
		$this->description=$description;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}medicine_categories(name,description,created_at,updated_at)values('$this->name','$this->description','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}medicine_categories set name='$this->name',description='$this->description',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}medicine_categories where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,description,created_at,updated_at from {$tx}medicine_categories");
		$data=[];
		while($medicinecategory=$result->fetch_object()){
			$data[]=$medicinecategory;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,description,created_at,updated_at from {$tx}medicine_categories $criteria limit $top,$perpage");
		$data=[];
		while($medicinecategory=$result->fetch_object()){
			$data[]=$medicinecategory;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}medicine_categories $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,description,created_at,updated_at from {$tx}medicine_categories where id='$id'");
		$medicinecategory=$result->fetch_object();
			return $medicinecategory;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}medicine_categories");
		$medicinecategory =$result->fetch_object();
		return $medicinecategory->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Description:$this->description<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbMedicineCategory"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}medicine_categories");
		while($medicinecategory=$result->fetch_object()){
			$html.="<option value ='$medicinecategory->id'>$medicinecategory->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}medicine_categories $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,description,created_at,updated_at from {$tx}medicine_categories $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-info\" href=\"create-medicinecategory\">Create Medicine Category</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Category Name</th><th>Category Description</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Description</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($medicinecategory=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button_icon(["id"=>$medicinecategory->id, "name"=>"Details", "value"=>"Details", "class"=>"success", "url"=>"details-medicinecategory"],"fas fa-info-circle");
				$action_buttons.= action_button_icon(["id"=>$medicinecategory->id, "name"=>"Edit", "value"=>"Edit", "class"=>"info", "url"=>"edit-medicinecategory"],"fas fa-edit");
				$action_buttons.= action_button_icon(["id"=>$medicinecategory->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"medicine_categories"],"fas fa-trash-alt");
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$medicinecategory->id</td><td>$medicinecategory->name</td><td>$medicinecategory->description</td><td>$medicinecategory->created_at</td><td>$medicinecategory->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,name,description,created_at,updated_at from {$tx}medicine_categories where id={$id}");
		$medicinecategory=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">MedicineCategory Details</th></tr>";
		$html.="<tr><th>Id</th><td>$medicinecategory->id</td></tr>";
		$html.="<tr><th>Name</th><td>$medicinecategory->name</td></tr>";
		$html.="<tr><th>Description</th><td>$medicinecategory->description</td></tr>";
		$html.="<tr><th>Created At</th><td>$medicinecategory->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$medicinecategory->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
