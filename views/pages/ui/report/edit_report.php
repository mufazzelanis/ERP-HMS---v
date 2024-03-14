<?php
if(isset($_POST["btnEdit"])){
	$report=Report::find($_POST["txtId"]);
}
if(isset($_POST["btnUpdate"])){
	$errors=[];
/*

*/
	if(count($errors)==0){
		$report=new Report();
		$report->id=$_POST["txtId"];

		$report->update();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="report">Manage Report</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='edit-report' method='post' enctype='multipart/form-data'>
<?php
	$html="";

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnUpdate", "value"=>"Update"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
