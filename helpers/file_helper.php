<?php
 //--------------------Upload--------------
 function upload($file,$path="img",$name=""){
    if(!file_exists($path)){
        mkdir($path, 0777, true);
    }	
    if(is_array($file)){       

                $ext=pathinfo($file["name"],PATHINFO_EXTENSION);
                $size=$file["size"]/1024;
                $type=$file["type"];
                if($type=="image/png" || $type=="image/jpeg"){
                    if($size<=1000){
                    $name=$name!=""?$name:$file["name"];
                        $name=slugify($name);

                        move_uploaded_file($file["tmp_name"],"$path/{$name}.{$ext}");

                        
                    }else{
                        return -2;
                    }
                }else{
                    return -1;
                }
       
    }
return "{$name}.{$ext}";

}


?>