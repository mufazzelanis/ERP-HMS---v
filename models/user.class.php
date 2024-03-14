<?php
class User implements JsonSerializable{
	public $id;
	public $username;
	public $role_id;
	public $password;
	public $email;
	public $full_name;
	public $created_at;
	public $photo;
	public $mobile;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$username,$role_id,$password,$email,$full_name,$created_at,$photo,$mobile,$updated_at){
		$this->id=$id;
		$this->username=$username;
		$this->role_id=$role_id;
		$this->password=$password;
		$this->email=$email;
		$this->full_name=$full_name;
		$this->created_at=$created_at;
		$this->photo=$photo;
		$this->mobile=$mobile;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}users(username,role_id,password,email,full_name,created_at,photo,mobile,updated_at)values('$this->username','$this->role_id','$this->password','$this->email','$this->full_name','$this->created_at','$this->photo','$this->mobile','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}users set username='$this->username',role_id='$this->role_id',password='$this->password',email='$this->email',full_name='$this->full_name',created_at='$this->created_at',photo='$this->photo',mobile='$this->mobile',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}users where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,username,role_id,password,email,full_name,created_at,photo,mobile,updated_at from {$tx}users");
		$data=[];
		while($user=$result->fetch_object()){
			$data[]=$user;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,username,role_id,password,email,full_name,created_at,photo,mobile,updated_at from {$tx}users $criteria limit $top,$perpage");
		$data=[];
		while($user=$result->fetch_object()){
			$data[]=$user;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}users $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,username,role_id,password,email,full_name,created_at,photo,mobile,updated_at from {$tx}users where id='$id'");
		$user=$result->fetch_object();
			return $user;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}users");
		$user =$result->fetch_object();
		return $user->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Username:$this->username<br> 
		Role Id:$this->role_id<br> 
		Password:$this->password<br> 
		Email:$this->email<br> 
		Full Name:$this->full_name<br> 
		Created At:$this->created_at<br> 
		Photo:$this->photo<br> 
		Mobile:$this->mobile<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbUser"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}users");
		while($user=$result->fetch_object()){
			$html.="<option value ='$user->id'>$user->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx;
		$count_result =$db->query("select count(*) total from {$tx}users $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,username,role_id,password,email,full_name,created_at,photo,mobile,updated_at from {$tx}users $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'><a class=\"btn btn-success\" href=\"create-user\">New User</a></th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Username</th><th>Role Id</th><th>Password</th><th>Email</th><th>Full Name</th><th>Created At</th><th>Photo</th><th>Mobile</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Username</th><th>Role Id</th><th>Password</th><th>Email</th><th>Full Name</th><th>Created At</th><th>Photo</th><th>Mobile</th><th>Updated At</th></tr>";
		}
		while($user=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='clearfix' style='display:flex;'>";
				$action_buttons.= action_button_icon(["id"=>$user->id, "name"=>"Details", "value"=>"Details", "class"=>"info", "url"=>"details-user"],"fas fa-info-circle");
				$action_buttons.= action_button_icon(["id"=>$user->id, "name"=>"Edit", "value"=>"Edit", "class"=>"primary", "url"=>"edit-user"],"fas fa-edit");
				$action_buttons.= action_button_icon(["id"=>$user->id, "name"=>"Delete", "value"=>"Delete", "class"=>"danger", "url"=>"users"],"fas fa-trash-alt");
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$user->id</td><td>$user->username</td><td>$user->role_id</td><td>$user->password</td><td>$user->email</td><td>$user->full_name</td><td>$user->created_at</td><td><img src='img/$user->photo' width='100' /></td><td>$user->mobile</td><td>$user->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx;
		$result =$db->query("select id,username,role_id,password,email,full_name,created_at,photo,mobile,updated_at from {$tx}users where id={$id}");
		$user=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">User Details</th></tr>";
		$html.="<tr><th>Id</th><td>$user->id</td></tr>";
		$html.="<tr><th>Username</th><td>$user->username</td></tr>";
		$html.="<tr><th>Role Id</th><td>$user->role_id</td></tr>";
		$html.="<tr><th>Password</th><td>$user->password</td></tr>";
		$html.="<tr><th>Email</th><td>$user->email</td></tr>";
		$html.="<tr><th>Full Name</th><td>$user->full_name</td></tr>";
		$html.="<tr><th>Created At</th><td>$user->created_at</td></tr>";
		$html.="<tr><th>Photo</th><td><img src=\'img/$user->photo\' width=\'100\' /></td></tr>";
		$html.="<tr><th>Mobile</th><td>$user->mobile</td></tr>";
		$html.="<tr><th>Updated At</th><td>$user->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
