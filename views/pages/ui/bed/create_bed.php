<?php
if(isset($_POST["btnCreate"])){
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
		$bed->name=$_POST["txtName"];
		$bed->category_id=$_POST["cmbBedCategoryId"];
		$bed->room_id=$_POST["cmbRoomId"];
		$bed->status_id=$_POST["cmbBedStatusId"];

		$bed->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-info" href="beds">Manage Bed</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-bed' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Name","type"=>"text","name"=>"txtName"]);
	$html.=select_field(["label"=>"Bed Category","name"=>"cmbBedCategoryId","table"=>"bed_categories"]);
	$html.=select_field(["label"=>"Room No","name"=>"cmbRoomId","table"=>"rooms"]);
	$html.=select_field(["label"=>"Room Status","name"=>"cmbBedStatusId","table"=>"bed_statuses"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
