<?php

function create_adjustment($warehouse_id,$adjustment_date,$adjustment_type_id,$remark,$products){

  $adjustment_date=date("Y-m-d",strtotime($adjustment_date));//convert date into mysql format
 
  $adjustment=new Stock_adjustment("",$adjustment_date,1,$remark,$adjustment_type_id,$warehouse_id);
  $adjustment_id=$adjustment->save();  

  $type_obj= Stock_adjustment_type::get_stock_adjustment_type($adjustment_type_id);
  
  $factor=$type_obj->get_factor();
  $now=date("Y-m-d H:i:s"); 

  foreach($products as $product){
    $adjdetails=new Stock_adjustment_detail("",$adjustment_id,$product["item_id"],$product["qty"],$product["price"]);
    $adjdetails->save();    
    $qty=$product["qty"]*$factor;  

    $s=new Stock("",$product["item_id"],$qty,1,"Adjustment",$now);//1 for sales order    
    $s->save();

  }

  echo "Saved";
 //echo $factor,"|",$warehouse_id,"|",$adjustment_date,"|",$adjustment_type_id,"|",$remark;

 // print_r($products);

}

?>