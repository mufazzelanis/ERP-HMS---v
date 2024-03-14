<?php

 class AuthApi{
 
    function login($data){
        global $db;
        global $tx;
        if(isset($data["signin"])){

                $username=$data["username"];
                $password=$data["password"];

                $result=$db->query("select id,username,role_id,email from {$tx}users where username='$username' and password='$password'");
                $u=$result->fetch_object();

                if($u!=null){
                        $jwt=new JWT;
                        $payload=[
                            "id"=>$u->id,
                            "name"=>$u->username,
                            "role_id"=>$u->role_id,
                            "email"=>$u->email,
                            "ip"=>get_ip(),
                            "iss"=>"jwt.server",
                            "aud"=>"intels.co"
                        ];

                        $token= $jwt->generate($payload);
                        
                        echo json_encode(["success"=>1,"token"=>$token]);
                }else{
                        echo json_encode(["success"=>0]);
                }     

        }

    }

    

    


}

 
?>
  

