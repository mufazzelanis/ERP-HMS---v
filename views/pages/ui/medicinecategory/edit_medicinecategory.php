<?php
if(isset($_POST["btnEdit"])){
	$medicinecategory=MedicineCategory::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtDescription"])){
		$errors["description"]="Invalid description";
	}

*/
	if(count($errors)==0){
		$medicinecategory=new MedicineCategory();
		$medicinecategory->id=$_POST["txtId"];
		$medicinecategory->name=$_POST["txtName"];
		$medicinecategory->description=$_POST["txtDescription"];
		$medicinecategory->created_at=$now;
		$medicinecategory->updated_at=$now;

		$medicinecategory->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="medicine_categories">Manage MedicineCategory</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-medicinecategory' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$medicinecategory->id"]);
	$html.=input_field(["label"=>"Name","type"=>"text","name"=>"txtName","value"=>"$medicinecategory->name"]);
	$html.=input_field(["label"=>"Description","type"=>"text","name"=>"txtDescription","value"=>"$medicinecategory->description"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
