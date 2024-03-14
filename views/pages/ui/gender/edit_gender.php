<?php
if(isset($_POST["btnEdit"])){
	$gender=Gender::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtGender"])){
		$errors["gender"]="Invalid gender";
	}

*/
	if(count($errors)==0){
		$gender=new Gender();
		$gender->id=$_POST["txtId"];
		$gender->gender=$_POST["txtGender"];

		$gender->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="genders">Manage Gender</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-gender' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Id","type"=>"hidden","name"=>"txtId","value"=>"$gender->id"]);
	$html.=input_field(["label"=>"Gender","type"=>"text","name"=>"txtGender","value"=>"$gender->gender"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
