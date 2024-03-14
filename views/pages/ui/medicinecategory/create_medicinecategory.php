<?php
if(isset($_POST["btnCreate"])){
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
		$medicinecategory->name=$_POST["txtName"];
		$medicinecategory->description=$_POST["txtDescription"];
		$medicinecategory->created_at=$now;
		$medicinecategory->updated_at=$now;

		$medicinecategory->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-info" href="medicine_categories">Manage Medicine Category</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-medicinecategory' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Category Name","type"=>"text","name"=>"txtName"]);
	$html.=input_field(["label"=>"Category Description","type"=>"text","name"=>"txtDescription"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
