<?php
class Medicine implements JsonSerializable{
	public $id;
	public $name;
	public $category_id;
	public $purchase_price;
	public $sale_price;
	public $store_box;
	public $quantity;
	public $generic_name;
	public $company;
	public $effects;
	public $expire_date;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$name,$category_id,$purchase_price,$sale_price,$store_box,$quantity,$generic_name,$company,$effects,$expire_date,$created_at,$updated_at){
		$this->id=$id;
		$this->name=$name;
		$this->category_id=$category_id;
		$this->purchase_price=$purchase_price;
		$this->sale_price=$sale_price;
		$this->store_box=$store_box;
		$this->quantity=$quantity;
		$this->generic_name=$generic_name;
		$this->company=$company;
		$this->effects=$effects;
		$this->expire_date=$expire_date;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}medicines(name,category_id,purchase_price,sale_price,store_box,quantity,generic_name,company,effects,expire_date,created_at,updated_at)values('$this->name','$this->category_id','$this->purchase_price','$this->sale_price','$this->store_box','$this->quantity','$this->generic_name','$this->company','$this->effects','$this->expire_date','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}medicines set name='$this->name',category_id='$this->category_id',purchase_price='$this->purchase_price',sale_price='$this->sale_price',store_box='$this->store_box',quantity='$this->quantity',generic_name='$this->generic_name',company='$this->company',effects='$this->effects',expire_date='$this->expire_date',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}medicines where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,category_id,purchase_price,sale_price,store_box,quantity,generic_name,company,effects,expire_date,created_at,updated_at from {$tx}medicines");
		$data=[];
		while($medicine=$result->fetch_object()){
			$data[]=$medicine;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,category_id,purchase_price,sale_price,store_box,quantity,generic_name,company,effects,expire_date,created_at,updated_at from {$tx}medicines $criteria limit $top,$perpage");
		$data=[];
		while($medicine=$result->fetch_object()){
			$data[]=$medicine;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}medicines $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,category_id,purchase_price,sale_price,store_box,quantity,generic_name,company,effects,expire_date,created_at,updated_at from {$tx}medicines where id='$id'");
		$medicine=$result->fetch_object();
			return $medicine;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}medicines");
		$medicine =$result->fetch_object();
		return $medicine->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Category Id:$this->category_id<br> 
		Purchase Price:$this->purchase_price<br> 
		Sale Price:$this->sale_price<br> 
		Store Box:$this->store_box<br> 
		Quantity:$this->quantity<br> 
		Generic Name:$this->generic_name<br> 
		Company:$this->company<br> 
		Effects:$this->effects<br> 
		Expire Date:$this->expire_date<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbMedicine"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}medicines");
		while($medicine=$result->fetch_object()){
			$html.="<option value ='$medicine->id'>$medicine->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}medicines $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result = $db->query("select m.id,m.name,mc.name category,m.purchase_price,m.sale_price,m.store_box,m.quantity,m.generic_name,m.company,m.effects,m.expire_date,m.created_at from {$tx}medicines m,{$tx}medicine_categories mc where m.category_id=mc.id $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-info\" href=\"create-medicine\">New Medicine</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Medicine Name</th><th>Medicine Category</th><th>Purchase Price</th><th>Sale Price</th><th>Store Name</th><th>Quantity</th><th>Generic Name</th><th>Company</th><th>Impact</th><th>Expire Date</th><th>Created Time</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Category</th><th>Purchase Price</th><th>Sale Price</th><th>Store Box</th><th>Quantity</th><th>Generic Name</th><th>Company</th><th>Effects</th><th>Expire Date</th><th>Created At</th></tr>";
		}
		while($medicine=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button_icon(["id"=>$medicine->id, "name"=>"Details", "value"=>"Details", "class"=>"success", "url"=>"details-medicine"],"fas fa-info-circle");
				$action_buttons.= action_button_icon(["id"=>$medicine->id, "name"=>"Edit", "value"=>"Edit", "class"=>"info", "url"=>"edit-medicine"],"fas fa-edit");
				$action_buttons.= action_button_icon(["id"=>$medicine->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"medicines"],"fas fa-trash-alt");
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$medicine->id</td><td>$medicine->name</td><td>$medicine->category</td><td>$medicine->purchase_price</td><td>$medicine->sale_price</td><td>$medicine->store_box</td><td>$medicine->quantity</td><td>$medicine->generic_name</td><td>$medicine->company</td><td>$medicine->effects</td><td>$medicine->expire_date</td><td>$medicine->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,name,category_id,purchase_price,sale_price,store_box,quantity,generic_name,company,effects,expire_date,created_at,updated_at from {$tx}medicines where id={$id}");
		$medicine=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Medicine Details</th></tr>";
		$html.="<tr><th>Id</th><td>$medicine->id</td></tr>";
		$html.="<tr><th>Name</th><td>$medicine->name</td></tr>";
		$html.="<tr><th>Category</th><td>$medicine->category</td></tr>";
		$html.="<tr><th>Purchase Price</th><td>$medicine->purchase_price</td></tr>";
		$html.="<tr><th>Sale Price</th><td>$medicine->sale_price</td></tr>";
		$html.="<tr><th>Store Box</th><td>$medicine->store_box</td></tr>";
		$html.="<tr><th>Quantity</th><td>$medicine->quantity</td></tr>";
		$html.="<tr><th>Generic Name</th><td>$medicine->generic_name</td></tr>";
		$html.="<tr><th>Company</th><td>$medicine->company</td></tr>";
		$html.="<tr><th>Effects</th><td>$medicine->effects</td></tr>";
		$html.="<tr><th>Expire Date</th><td>$medicine->expire_date</td></tr>";
		$html.="<tr><th>Created At</th><td>$medicine->created_at</td></tr>";
		// $html.="<tr><th>Updated At</th><td>$medicine->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
