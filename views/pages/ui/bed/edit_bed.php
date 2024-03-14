<?php
if(isset($_POST["btnEdit"])){
	$bed=Bed::find($_POST["txtId"]);
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
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbRoomId"])){
		$errors["room_id"]="Invalid room_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbStatusId"])){
		$errors["status_id"]="Invalid status_id";
	}

*/
	if(count($errors)==0){
		$bed=new Bed();
		$bed->id=$_POST["txtId"];
		$bed->name=$_POST["txtName"];
		$bed->category_id=$_POST["cmbBedCategoryId"];
		$bed->room_id=$_POST["cmbRoomId"];
		$bed->status_id=$_POST["cmbBedStatusId"];

		$bed->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="beds">Manage Bed</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-bed' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$bed->id"]);
	$html.=input_field(["label"=>"Name","type"=>"text","name"=>"txtName","value"=>"$bed->name"]);
	$html.=select_field(["label"=>"Category","name"=>"cmbBedCategoryId","table"=>"bed_categories","value"=>"$bed->category_id"]);
	$html.=select_field(["label"=>"Room","name"=>"cmbRoomId","table"=>"rooms","value"=>"$bed->room_id"]);
	$html.=select_field(["label"=>"Status","name"=>"cmbBedStatusId","table"=>"bed_statuses","value"=>"$bed->status_id"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
