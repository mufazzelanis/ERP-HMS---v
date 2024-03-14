<?php
class UserApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["users"=>User::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["users"=>User::pagination($page,$perpage),"total_records"=>User::count()]);
	}
	function find($data){
		echo json_encode(["user"=>User::find($data["id"])]);
	}
	function delete($data){
		User::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$user=new User();
		$user->username=$data["username"];
		$user->role_id=$data["role_id"];
		$user->password=$data["password"];
		$user->email=$data["email"];
		$user->full_name=$data["full_name"];
		$user->photo=upload($file["photo"], "../img",$data["username"]);
		$user->verify_code=$data["verify_code"];
		$user->inactive=$data["inactive"];
		$user->mobile=$data["mobile"];

		$user->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$user=new User();
		$user->id=$data["id"];
		$user->username=$data["username"];
		$user->role_id=$data["role_id"];
		$user->password=$data["password"];
		$user->email=$data["email"];
		$user->full_name=$data["full_name"];
		
		if(isset($file["photo"]["name"])){
			$user->photo=upload($file["photo"], "../img",$data["username"]);
		}else{
			$user->photo=User::find($data["id"])->photo;
		}
		$user->verify_code=$data["verify_code"];
		$user->inactive=$data["inactive"];
		$user->mobile=$data["mobile"];

		$user->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
