<?php
class Report implements JsonSerializable{

	public function __construct(){
	}
	public function set(){

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}report()values()");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}report set  where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}report where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select  from {$tx}report");
		$data=[];
		while($report=$result->fetch_object()){
			$data[]=$report;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select  from {$tx}report $criteria limit $top,$perpage");
		$data=[];
		while($report=$result->fetch_object()){
			$data[]=$report;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}report $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select  from {$tx}report where id='$id'");
		$report=$result->fetch_object();
			return $report;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}report");
		$report =$result->fetch_object();
		return $report->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "";
	}

	//-------------HTML----------//

	static function html_select($name="cmbReport"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}report");
		while($report=$result->fetch_object()){
			$html.="<option value ='$report->id'>$report->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}report $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select  from {$tx}report $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-report\">New Report</a></th></tr>";
		if($action){
			$html.="<tr><th>Action</th></tr>";
		}else{
			$html.="<tr></tr>";
		}
		while($report=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$report->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-report"]);
				$action_buttons.= action_button(["id"=>$report->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-report"]);
				$action_buttons.= action_button(["id"=>$report->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"report"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select  from {$tx}report where id={$id}");
		$report=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Report Details</th></tr>";

		$html.="</table>";
		return $html;
	}

	// public static function label_test_report($date){
	// 	global $db, $tx;
	// 	$result = $db->query("SELECT i.id,l.name AS label_test,i.discount,i.total,i.invoice_date FROM {$tx}invoices i JOIN {$tx}invoice_details ids ON i.id=ids.invoice_id JOIN {$tx}patients p ON i.patient_id=p.id JOIN {$tx}doctors d ON i.doctor_id=d.id JOIN {$tx}labe_tests l ON ids.labe_test_id=l.id WHERE DATE_FORMAT(i.invoice_date,'%Y-%m-%d')='$date';");

	// 	$html = "<div style='background-color:#fff;padding:15px;border:1px solid #dee2e6;margin-top:10px'>";
	// 	$html .= "<table class='table table-hover'>";
	// 	$html .= "<tr class='thead-light'><th>#SL</th><th>Test Name</th><th>Discount</th><th>Total</th><th>Date</th>";
		
	// 	//initialize variable
	// 	$discount = 0;
	// 	$Total = 0;
	// 	$paidTotal = 0;
	// 	$due = 0;
	// 	$i=1;
	// 	while($item = $result->fetch_object()){
	// 		$html .= "<tr><td>$i</td><td>$item->label_test</td><td>$item->discount</td><td>$item->total</td><td>$item->invoice_date</td>";
	
	// 		$discount += $item->discount;
	// 		$Total += $item->total;
	// 		$paidTotal += $item->paid_total;
	// 		$due += $item->due;
	// 		$i++;
	// 	}
	
	// 	$html .= "<tr style='border-top:2px solid #dee2e6;'><td></td><td></td><td></td><td></td><td></td><td><strong>Discount:</strong></td><td>$discount</td></tr>";
	// 	$html .= "<tr><td></td><td></td><td></td><td></td><td></td><td><strong>Total:</strong></td><td>$Total</td></tr>";
	// 	$html .= "<tr><td></td><td></td><td></td><td></td><td></td><td><strong>Paid Total:</strong></td><td>$paidTotal</td></tr>";
	// 	$html .= "<tr><td></td><td></td><td></td><td></td><td></td><td><strong>Due:</strong></td><td>$due</td></tr>";
	// 	$html .= "</table>";
	// 	$html .= "<div class='no-print clearfix'><a href='javascript:void(0)' onclick='window.print()' rel='noopener' target='_blank' class='btn btn-outline-secondary float-right'><i class='fas fa-print'></i> Print</a></div>";
	// 	$html.="</div>";
	// 	return $html;
	// }
}


?>
