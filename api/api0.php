<?php
require_once("../configs/db_config.php");

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

//require_once("../models/_customer.class.php");

foreach (glob("../helpers/*_helper.php") as $filename)
{
    include $filename;
}

foreach (glob("../models/*.class.php") as $filename)
{
    include $filename;
}

foreach (glob("*_api.php") as $filename)
{
    include $filename;
}



/*
if(isset($_GET["method"])){ 

     $method=$_GET["method"];    
     if(function_exists($method)){
      $params=array_values($_POST);   
      call_user_func_array($method,$params);
     }else{
       echo "Method is not exists";
     }
}
*/

 

if(isset($_GET["method"])){ 

     $method=$_GET["method"];    
     $res_method = $_SERVER['REQUEST_METHOD'];

     if(function_exists($method)){
       
        if($res_method=="POST"){

          //$params=array_values($_POST); 
          $params=$_POST;
           

        }else if($res_method=="GET"){ 
          //$params=array_values($_GET); 
          $params=$_GET;         

        }else if($res_method=="PUT"){
          
          parse_str(file_get_contents("php://input"),$_PUT); 
          
         // $params=array_values($_PUT);         
          $params=$_PUT; 

        }else if($res_method=="DELETE"){

          parse_str(file_get_contents("php://input"),$_DELETE);      
          
         // $params=array_values($_DELETE);    
          $params=$_DELETE; 
        }

         call_user_func_array($method,[$params,$_FILES]);

     }else{
       echo "Method is not exists";
     }

}


?>