<?php
class PresmedicineDetail implements JsonSerializable{
	public $id;
	public $prescription_id;
	public $medicine_id;
	public $dosage;
	public $days;
	public $instructions;

	public function __construct(){
	}
	public function set($id,$prescription_id,$medicine_id,$dosage,$days,$instructions){
		$this->id=$id;
		$this->prescription_id=$prescription_id;
		$this->medicine_id=$medicine_id;
		$this->dosage=$dosage;
		$this->days=$days;
		$this->instructions=$instructions;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}presmedicine_details(prescription_id,medicine_id,dosage,days,instructions)values('$this->prescription_id','$this->medicine_id','$this->dosage','$this->days','$this->instructions')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}presmedicine_details set prescription_id='$this->prescription_id',medicine_id='$this->medicine_id',dosage='$this->dosage',days='$this->days',instructions='$this->instructions' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}presmedicine_details where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,prescription_id,medicine_id,dosage,days,instructions from {$tx}presmedicine_details");
		$data=[];
		while($presmedicinedetail=$result->fetch_object()){
			$data[]=$presmedicinedetail;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,prescription_id,medicine_id,dosage,days,instructions from {$tx}presmedicine_details $criteria limit $top,$perpage");
		$data=[];
		while($presmedicinedetail=$result->fetch_object()){
			$data[]=$presmedicinedetail;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}presmedicine_details $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,prescription_id,medicine_id,dosage,days,instructions from {$tx}presmedicine_details where id='$id'");
		$presmedicinedetail=$result->fetch_object();
			return $presmedicinedetail;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}presmedicine_details");
		$presmedicinedetail =$result->fetch_object();
		return $presmedicinedetail->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Prescription Id:$this->prescription_id<br> 
		Medicine Id:$this->medicine_id<br> 
		Dosage:$this->dosage<br> 
		Days:$this->days<br> 
		Instructions:$this->instructions<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbPresmedicineDetail"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}presmedicine_details");
		while($presmedicinedetail=$result->fetch_object()){
			$html.="<option value ='$presmedicinedetail->id'>$presmedicinedetail->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}presmedicine_details $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,prescription_id,medicine_id,dosage,days,instructions from {$tx}presmedicine_details $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-presmedicinedetail\">New PresmedicineDetail</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Prescription Id</th><th>Medicine Id</th><th>Dosage</th><th>Days</th><th>Instructions</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Prescription Id</th><th>Medicine Id</th><th>Dosage</th><th>Days</th><th>Instructions</th></tr>";
		}
		while($presmedicinedetail=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$presmedicinedetail->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-presmedicinedetail"]);
				$action_buttons.= action_button(["id"=>$presmedicinedetail->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-presmedicinedetail"]);
				$action_buttons.= action_button(["id"=>$presmedicinedetail->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"presmedicine_details"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$presmedicinedetail->id</td><td>$presmedicinedetail->prescription_id</td><td>$presmedicinedetail->medicine_id</td><td>$presmedicinedetail->dosage</td><td>$presmedicinedetail->days</td><td>$presmedicinedetail->instructions</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,prescription_id,medicine_id,dosage,days,instructions from {$tx}presmedicine_details where id={$id}");
		$presmedicinedetail=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">PresmedicineDetail Details</th></tr>";
		$html.="<tr><th>Id</th><td>$presmedicinedetail->id</td></tr>";
		$html.="<tr><th>Prescription Id</th><td>$presmedicinedetail->prescription_id</td></tr>";
		$html.="<tr><th>Medicine Id</th><td>$presmedicinedetail->medicine_id</td></tr>";
		$html.="<tr><th>Dosage</th><td>$presmedicinedetail->dosage</td></tr>";
		$html.="<tr><th>Days</th><td>$presmedicinedetail->days</td></tr>";
		$html.="<tr><th>Instructions</th><td>$presmedicinedetail->instructions</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
