<?php
if(isset($_POST["btnCreate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtGender"])){
		$errors["gender"]="Invalid gender";
	}

*/
	if(count($errors)==0){
		$gender=new Gender();
		$gender->gender=$_POST["txtGender"];

		$gender->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="genders">Manage Gender</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-gender' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Gender","type"=>"text","name"=>"txtGender"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
