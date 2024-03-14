<?php
if(isset($_POST["btnCreate"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbDoctorId"])){
		$errors["doctor_id"]="Invalid doctor_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["cmbWeekdayId"])){
		$errors["weekday_id"]="Invalid weekday_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtStartTime"])){
		$errors["start_time"]="Invalid start_time";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtEndTime"])){
		$errors["end_time"]="Invalid end_time";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtDuration"])){
		$errors["duration"]="Invalid duration";
	}

*/
	if(count($errors)==0){
		$schedule=new Schedule();
		$schedule->doctor_id=$_POST["cmbDoctorId"];
		$schedule->weekday_id=$_POST["cmbWeekdayId"];
		$schedule->start_time=$_POST["txtStartTime"];
		$schedule->end_time=$_POST["txtEndTime"];
		$schedule->duration=$_POST["txtDuration"];

		$schedule->save();
	}else{
		 print_r($errors);
	}
}
?>
<div class="p-4">
<a class="btn btn-success" href="schedules">Manage Schedule</a>
<?php echo form_wrap_open();?>
<form class='form-horizontal' action='create-schedule' method='post' enctype='multipart/form-data'>
<?php
	$html="";
	$html.=select_field(["label"=>"Doctor Name","name"=>"cmbDoctorId","table"=>"doctors"]);
	$html.=select_field(["label"=>"Weekday","name"=>"cmbWeekdayId","table"=>"weekdays"]);
	$html.=input_field(["label"=>"Start Time","type"=>"time","name"=>"txtStartTime"]);
	$html.=input_field(["label"=>"End Time","type"=>"time","name"=>"txtEndTime"]);
	$html.=input_field(["label"=>"Duration","type"=>"text","name"=>"txtDuration"]);

	echo $html;
?>
<?php
	$html = input_button(["type"=>"submit", "name"=>"btnCreate", "value"=>"Create"]);
	echo $html;
?>
</form>
<?php echo form_wrap_close();?>
</div>
