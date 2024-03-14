<?php
class System_log{
	public $id;
	public $name;
	public $description;
	public $created_at;

	function __construct($_id,$_name,$_description,$_created_at){
		$this->id=$_id;
		$this->name=$_name;
		$this->description=$_description;
		$this->created_at=$_created_at;
	}

	static function get_last_id(){
		global $db;
		$db->query("select max(id) from system_log");
		list($last_id)=$result->fetch_row();
		return $last_id;
	}

	function save(){
		global $db;
		$db->query("insert into system_log(name,description,created_at)values('$this->name','$this->description','$this->created_at')");
		return $db->insert_id;
	}

	function update(){
		global $db;
		$db->query("update system_log set name='$this->name',description='$this->description',created_at='$this->created_at' where id='$this->id'");
	}

	static function delete($id){
		global $db;
		$db->query("delete from system_log where id='$id'");
	}

	static function get_system_log($id){
		global $db;
		$result=$db->query("select name,description,created_at from system_log where id='$id'");
		list($name,$description,$created_at)=$result->fetch_row();
		$system_log=new System_log($id,$name,$description,$created_at);
		return $system_log;
	}

	static function system_log_selectbox($name="cmbSystem_log"){
		global $db;
		$result=$db->query("select id,name from system_log");
		$html="<select id='$name' name='$name'>";
		while(list($id,$name)=$result->fetch_row()){
			$html.="<option value='$id'>$name</option>";
		}
		$html.="</select>";
		return $html;
	}

	static function manage_system_logs($page=1,$limit=10){
		global $db;
		
		$total_result=$db->query("select count(*) from system_log");
		list($total_rows)=$total_result->fetch_row();
		
		
		$top=($page-1)*$limit;

		$previous_page = $page - 1;
		$next_page = $page + 1;
		$adjacents = "2";
		$total_pages = ceil($total_rows / $limit);
		$second_last = $total_pages - 1;
		
		$result=$db->query("select id,name,description,created_at from system_log limit $top,$limit");



		$html="<table class='table'>";
		$html.="<tr><th>Id</th><th>Name</th><th>Description</th><th>Created_at</th></tr>";
		while(list($id,$name,$description,$created_at)=$result->fetch_row()){
			$action_buttons="<div class='clearfix'>";
			
			$action_buttons.=action_button(["id"=>$id,"name"=>"Delete","value"=>"Delete","class"=>"danger","url"=>"manage-system-log"]);
			$action_buttons.="</div>";
			$html.="<tr><td>$id</td><td>$name</td><td>$description</td><td>$created_at</td><td>$action_buttons</td></tr>";
		}
		$html.="</table>";

		//Page Status
		$html.="<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>";
		$html.="<strong>Page $page of $total_pages </strong>";
		$html.="</div>";

		$html.="<ul class='paginaion' style='list-style:none;display:inline;padding:0;margin:0'>";
		
		if($page > 1){
		  $html.= "<li><a href='?pg=1'>First</a></li>";
		}

		if($page <= 1){			
			$html.= "<li><a style='color:gray'  class='disabled'>Previous</a></li>";		
		}else{
			$html.= "<li><a href='?pg=$previous_page' class='disabled'>Previous</a></li>";
		}


		if ($total_pages <= 4){  	 
			for ($counter = 1; $counter <= $total_pages; $counter++){
				if ($counter == $page) {
				    $html.= "<li class='active'><a>$counter</a></li>";	
				}else{
					$html.=  "<li><a href='?pg=$counter'>$counter</a></li>";
				}
			}
		}

		if($page >= $total_pages){			
			$html.= "<li><a style='color:gray'  class='disabled'>Next</a></li>";		
		}else{
			$html.= "<li><a href='?pg=$next_page' class='disabled'>Next</a></li>";
		}

		if($page < $total_pages){
		  $html.= "<li><a href='?pg=$total_pages'>Last</a></li>";
		}

		
		$html.="";		
		$html.="</ul>";


		return $html;
	}



	static function get_system_logs(){
		global $db;
		$result=$db->query("select id,name,description,created_at from system_log ");
		$html="<table class='table'>";
		$html.="<tr><th>Id</th><th>Name</th><th>Description</th><th>Created_at</th></tr>";
		while(list($id,$name,$description,$created_at)=$result->fetch_row()){
			$html.="<tr><td>$id</td><td>$name</td><td>$description</td><td>$created_at</td></tr>";
		}
		$html.="</table>";
		return $html;
	}

}
?>