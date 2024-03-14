<?php
class InvoiceDetail implements JsonSerializable{
	public $id;
	public $labe_test_id;
	public $price;
	public $date;
	public $invoice_id;

	public function __construct(){
	}
	public function set($id,$labe_test_id,$price,$date,$invoice_id){
		$this->id=$id;
		$this->labe_test_id=$labe_test_id;
		$this->price=$price;
		$this->date=$date;
		$this->invoice_id=$invoice_id;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}invoice_details(labe_test_id,price,date,invoice_id)values('$this->labe_test_id','$this->price','$this->date','$this->invoice_id')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}invoice_details set labe_test_id='$this->labe_test_id',price='$this->price',date='$this->date',invoice_id='$this->invoice_id' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}invoice_details where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,labe_test_id,price,date,invoice_id from {$tx}invoice_details");
		$data=[];
		while($invoicedetail=$result->fetch_object()){
			$data[]=$invoicedetail;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,labe_test_id,price,date,invoice_id from {$tx}invoice_details $criteria limit $top,$perpage");
		$data=[];
		while($invoicedetail=$result->fetch_object()){
			$data[]=$invoicedetail;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}invoice_details $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,labe_test_id,price,date,invoice_id from {$tx}invoice_details where id='$id'");
		$invoicedetail=$result->fetch_object();
			return $invoicedetail;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}invoice_details");
		$invoicedetail =$result->fetch_object();
		return $invoicedetail->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Labe Test Id:$this->labe_test_id<br> 
		Price:$this->price<br> 
		Date:$this->date<br> 
		Invoice Id:$this->invoice_id<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbInvoiceDetail"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}invoice_details");
		while($invoicedetail=$result->fetch_object()){
			$html.="<option value ='$invoicedetail->id'>$invoicedetail->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}invoice_details $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,labe_test_id,price,date,invoice_id from {$tx}invoice_details $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-invoicedetail\">New InvoiceDetail</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Labe Test Id</th><th>Price</th><th>Date</th><th>Invoice Id</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Labe Test Id</th><th>Price</th><th>Date</th><th>Invoice Id</th></tr>";
		}
		while($invoicedetail=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button(["id"=>$invoicedetail->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-invoicedetail"]);
				$action_buttons.= action_button(["id"=>$invoicedetail->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-invoicedetail"]);
				$action_buttons.= action_button(["id"=>$invoicedetail->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"invoice_details"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$invoicedetail->id</td><td>$invoicedetail->labe_test_id</td><td>$invoicedetail->price</td><td>$invoicedetail->date</td><td>$invoicedetail->invoice_id</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,labe_test_id,price,date,invoice_id from {$tx}invoice_details where id={$id}");
		$invoicedetail=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">InvoiceDetail Details</th></tr>";
		$html.="<tr><th>Id</th><td>$invoicedetail->id</td></tr>";
		$html.="<tr><th>Labe Test Id</th><td>$invoicedetail->labe_test_id</td></tr>";
		$html.="<tr><th>Price</th><td>$invoicedetail->price</td></tr>";
		$html.="<tr><th>Date</th><td>$invoicedetail->date</td></tr>";
		$html.="<tr><th>Invoice Id</th><td>$invoicedetail->invoice_id</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
