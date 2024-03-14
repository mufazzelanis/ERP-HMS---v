<?php
class Invoice implements JsonSerializable{
	public $id;
	public $patient_id;
	public $doctor_id;
	public $item;
	public $discount;
	public $total;
	public $remark;
	public $invoice_date;

	public function __construct(){
	}
	public function set($id,$patient_id,$doctor_id,$discount,$total,$remark,$invoice_date){
		$this->id=$id;
		$this->patient_id=$patient_id;
		$this->doctor_id=$doctor_id;
		// $this->item=$item;
		$this->discount=$discount;
		$this->total=$total;
		$this->remark=$remark;
		$this->invoice_date=$invoice_date;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}invoices(patient_id,doctor_id,discount,total,remark,invoice_date)values('$this->patient_id','$this->doctor_id','$this->discount','$this->total','$this->remark','$this->invoice_date')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}invoices set patient_id='$this->patient_id',doctor_id='$this->doctor_id',discount='$this->discount',total='$this->total',remark='$this->remark',invoice_date='$this->invoice_date' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}invoices where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,patient_id,doctor_id,discount,total,remark,invoice_date from {$tx}invoices");
		$data=[];
		while($invoice=$result->fetch_object()){
			$data[]=$invoice;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,patient_id,doctor_id,discount,total,remark,invoice_date from {$tx}invoices $criteria limit $top,$perpage");
		$data=[];
		while($invoice=$result->fetch_object()){
			$data[]=$invoice;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}invoices $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,patient_id,doctor_id,discount,total,remark,invoice_date from {$tx}invoices where id='$id'");
		$invoice=$result->fetch_object();
			return $invoice;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}invoices");
		$invoice =$result->fetch_object();
		return $invoice->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Patient Id:$this->patient_id<br> 
		Doctor Id:$this->doctor_id<br> 
		Item:$this->item<br> 
		Discount:$this->discount<br> 
		Total:$this->total<br> 
		Remark:$this->remark<br> 
		Date:$this->invoice_date<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbInvoice"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}invoices");
		while($invoice=$result->fetch_object()){
			$html.="<option value ='$invoice->id'>$invoice->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}invoices $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("SELECT i.id,p.name patient,d.name doctor,i.discount,i.total,i.remark,i.invoice_date from {$tx}invoices i, {$tx}patients p, {$tx}doctors d where p.id=i.patient_id and d.id=i.doctor_id $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-invoice\">New Invoice</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Patient Name</th><th>Doctor Name</th><th>Discount</th><th>Total</th><th>Remark</th><th>Date</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Patient Name</th><th>Doctor Name</th><th>Discount</th><th>Total</th><th>Remark</th><th>Date</th></tr>";
		}
		while($invoice=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button_icon(["id"=>$invoice->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-invoice"],"fas fa-info-circle");
				$action_buttons.= action_button_icon(["id"=>$invoice->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-invoice"],"fas fa-edit");
				$action_buttons.= action_button_icon(["id"=>$invoice->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"invoices"],"fas fa-trash-alt");
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$invoice->id</td><td>$invoice->patient</td><td>$invoice->doctor</td><td>$invoice->discount</td><td>$invoice->total</td><td>$invoice->remark</td><td>$invoice->invoice_date</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,patient_id,doctor_id,discount,total,remark,invoice_date from {$tx}invoices where id={$id}");
		$invoice=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Invoice Details</th></tr>";
		$html.="<tr><th>Id</th><td>$invoice->id</td></tr>";
		$html.="<tr><th>Patient Id</th><td>$invoice->patient_id</td></tr>";
		$html.="<tr><th>Doctor Id</th><td>$invoice->doctor_id</td></tr>";
		// $html.="<tr><th>Item</th><td>$invoice->item</td></tr>";
		$html.="<tr><th>Discount</th><td>$invoice->discount</td></tr>";
		$html.="<tr><th>Total</th><td>$invoice->total</td></tr>";
		$html.="<tr><th>Remark</th><td>$invoice->remark</td></tr>";
		$html.="<tr><th>Date</th><td>$invoice->invoice_date</td></tr>";

		$html.="</table>";
		return $html;
	}

	//sels report start
	public static function label_test_report($date){
		global $db, $tx;
		$result = $db->query("SELECT i.id,l.name AS label_test,i.discount,i.total,i.invoice_date FROM {$tx}invoices i JOIN {$tx}invoice_details ids ON i.id=ids.invoice_id JOIN {$tx}patients p ON i.patient_id=p.id JOIN {$tx}doctors d ON i.doctor_id=d.id JOIN {$tx}labe_tests l ON ids.labe_test_id=l.id WHERE DATE_FORMAT(i.invoice_date,'%Y-%m-%d')='$date';");

		$html = "<div style='background-color:#fff;padding:15px;border:1px solid #dee2e6;margin-top:10px'>";
		$html .= "<table class='table table-hover'>";
		$html .= "<tr class='thead-light'><th>#SL</th><th>Test Name</th><th>Discount</th><th>Total</th><th>Date</th>";
		
		//initialize variable
		$discount = 0;
		$Total = 0;
		// $paidTotal = 0;
		// $due = 0;
		$i=1;
		while($item = $result->fetch_object()){
			$html .= "<tr><td>$i</td><td>$item->label_test</td><td>$item->discount</td><td>$item->total</td><td>$item->invoice_date</td>";
	
			$discount += $item->discount;
			$Total += $item->total;
			// $paidTotal += $item->paid_total;
			// $due += $item->due;
			$i++;
		}
	
		$html .= "<tr style='border-top:2px solid #dee2e6;'><td></td><td></td><td></td><td></td><td></td><td><strong>Discount:</strong></td><td>$discount</td></tr>";
		$html .= "<tr><td></td><td></td><td></td><td></td><td></td><td><strong>Total:</strong></td><td>$Total</td></tr>";
		// $html .= "<tr><td></td><td></td><td></td><td></td><td></td><td><strong>Paid Total:</strong></td><td>$paidTotal</td></tr>";
		// $html .= "<tr><td></td><td></td><td></td><td></td><td></td><td><strong>Due:</strong></td><td>$due</td></tr>";
		$html .= "</table>";
		$html .= "<div class='no-print clearfix'><a href='javascript:void(0)' onclick='window.print()' rel='noopener' target='_blank' class='btn btn-outline-secondary float-right'><i class='fas fa-print'></i> Print</a></div>";
		$html.="</div>";
		return $html;
	}
	//sels report End
}
?>
