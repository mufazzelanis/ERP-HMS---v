<?php
if(isset($_POST["btnEdit"])){
	$medicine=Medicine::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbCategoryId"])){
		$errors["category_id"]="Invalid category_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPurchasePrice"])){
		$errors["purchase_price"]="Invalid purchase_price";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtSalePrice"])){
		$errors["sale_price"]="Invalid sale_price";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtStoreBox"])){
		$errors["store_box"]="Invalid store_box";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtQuantity"])){
		$errors["quantity"]="Invalid quantity";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtGenericName"])){
		$errors["generic_name"]="Invalid generic_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtCompany"])){
		$errors["company"]="Invalid company";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtEffects"])){
		$errors["effects"]="Invalid effects";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtExpireDate"])){
		$errors["expire_date"]="Invalid expire_date";
	}

*/
	if(count($errors)==0){
		$medicine=new Medicine();
		$medicine->id=$_POST["txtId"];
		$medicine->name=$_POST["txtName"];
		$medicine->category_id=$_POST["cmbCategoryId"];
		$medicine->purchase_price=$_POST["txtPurchasePrice"];
		$medicine->sale_price=$_POST["txtSalePrice"];
		$medicine->store_box=$_POST["txtStoreBox"];
		$medicine->quantity=$_POST["txtQuantity"];
		$medicine->generic_name=$_POST["txtGenericName"];
		$medicine->company=$_POST["txtCompany"];
		$medicine->effects=$_POST["txtEffects"];
		$medicine->expire_date=$_POST["txtExpireDate"];
		$medicine->created_at=$now;
		$medicine->updated_at=$now;

		$medicine->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="medicines">Manage Medicine</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-medicine' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$medicine->id"]);
	$html.=input_field(["label"=>"Name","type"=>"text","name"=>"txtName","value"=>"$medicine->name"]);
	$html.=select_field(["label"=>"Category","name"=>"cmbCategoryId","table"=>"medicine_categories","value"=>"$medicine->category_id"]);
	$html.=input_field(["label"=>"Purchase Price","type"=>"text","name"=>"txtPurchasePrice","value"=>"$medicine->purchase_price"]);
	$html.=input_field(["label"=>"Sale Price","type"=>"text","name"=>"txtSalePrice","value"=>"$medicine->sale_price"]);
	$html.=input_field(["label"=>"Store Box","type"=>"text","name"=>"txtStoreBox","value"=>"$medicine->store_box"]);
	$html.=input_field(["label"=>"Quantity","type"=>"text","name"=>"txtQuantity","value"=>"$medicine->quantity"]);
	$html.=input_field(["label"=>"Generic Name","type"=>"text","name"=>"txtGenericName","value"=>"$medicine->generic_name"]);
	$html.=input_field(["label"=>"Company","type"=>"text","name"=>"txtCompany","value"=>"$medicine->company"]);
	$html.=input_field(["label"=>"Effects","type"=>"text","name"=>"txtEffects","value"=>"$medicine->effects"]);
	$html.=input_field(["label"=>"Expire Date","type"=>"text","name"=>"txtExpireDate","value"=>"$medicine->expire_date"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
