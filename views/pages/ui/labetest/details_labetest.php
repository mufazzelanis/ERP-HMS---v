<?php
if(isset($_POST["btnDetails"])){
	$labetest=LabeTest::find($_POST["txtId"]);
}
?>
<div class="p-4">
<a class="btn btn-success" href="labe_tests">Manage LabeTest</a>
<?php echo table_wrap_open();?>
<table class='table'>
	<tr><th colspan='2'>LabeTest Details</th></tr>
<?php
	$html="";
		$html.="<tr><th>Id</th><td>$labetest->id</td></tr>";
		$html.="<tr><th>Name</th><td>$labetest->name</td></tr>";
		$html.="<tr><th>Price</th><td>$labetest->price</td></tr>";

	echo $html;
?>
</table>
<?php echo table_wrap_close();?>
</div>
