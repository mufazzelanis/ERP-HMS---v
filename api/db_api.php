<?php


   //--------------API Functions--------------------------//

   function descTable($data){
     global $db;
    $result=$db->query("desc {$data["table"]}");

    if($result!=null){
      echo "<table class='table'>";
      echo "<tr><th>Field</th><th>DataType</th><th>Null</th><th>Key</th><th>Default Value</th><th>Auto Fill</th></tr>";
      while(list($name,$type,$null,$attr,$attr2,$auto)=$result->fetch_row()){
       echo "<tr><td>".$name."</td><td>".$type."</td><td>".$null."</td><td>".$attr."</td><td>".$attr2."</td><td>".$auto."</td></tr>";
      }
      echo "</table>";
    }
   }



?>