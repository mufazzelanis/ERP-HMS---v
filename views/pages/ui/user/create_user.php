<?php
if(isset($_POST["btnCreate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtUsername"])){
		$errors["username"]="Invalid username";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtRoleId"])){
		$errors["role_id"]="Invalid role_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPassword"])){
		$errors["password"]="Invalid password";
	}
	if(!is_valid_email($_POST["txtEmail"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtFullName"])){
		$errors["full_name"]="Invalid full_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhoto"])){
		$errors["photo"]="Invalid photo";
	}
	if(!is_valid_mobile($_POST["txtMobile"])){
		$errors["mobile"]="Invalid mobile";
	}

*/
	if(count($errors)==0){
		$user=new User();
		$user->username=$_POST["txtUsername"];
		$user->role_id=$_POST["txtRoleId"];
		$user->password=$_POST["txtPassword"];
		$user->email=$_POST["txtEmail"];
		$user->full_name=$_POST["txtFullName"];
		$user->created_at=$now;
		$user->photo=upload($_FILES["filePhoto"], "img",date("YmdHis"));
		$user->mobile=$_POST["txtMobile"];
		$user->updated_at=$now;
		$user->updated_at=$now;

		$user->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="users">Manage User</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-user' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=input_field(["label"=>"Username","type"=>"text","name"=>"txtUsername"]);
	$html.=input_field(["label"=>"Role Id","type"=>"text","name"=>"txtRoleId"]);
	$html.=input_field(["label"=>"Password","type"=>"text","name"=>"txtPassword"]);
	$html.=input_field(["label"=>"Email","type"=>"text","name"=>"txtEmail"]);
	$html.=input_field(["label"=>"Full Name","type"=>"text","name"=>"txtFullName"]);
	$html.=input_field(["label"=>"Photo","type"=>"file","name"=>"filePhoto"]);
	$html.=input_field(["label"=>"Mobile","type"=>"text","name"=>"txtMobile"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
