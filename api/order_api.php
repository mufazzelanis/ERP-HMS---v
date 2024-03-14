<?php

class OrderApi{

  static function save($data){  

   
    $order_date=$data["order_date"];
    $due_date=$data["delivery_date"];   
    $order_date=date("Y-m-d",strtotime($order_date));//convert date into mysql format
    $due_date=date("Y-m-d",strtotime($due_date));//convert date into mysql format

    $products=$data["products"];
       
    $order=new Order();  
		$order->customer_id=$data["customer_id"];
		$order->order_date=$order_date;
		$order->delivery_date=$due_date;
		$order->shipping_address=$data["shipping_address"];
		$order->order_total=$data["order_total"];		
		$order->remark=$data["remark"];
		$order->status_id=1;
		$order->discount=$data["discount"];
		$order->vat=$data["vat"];

    $order_id=$order->save();  
    
    $now=date("Y-m-d H:i:s"); 

    foreach($products as $product){
      $orderdetails=new OrderDetail();
      
      $orderdetails->order_id=$order_id;
      $orderdetails->product_id=$product["item_id"];
      $orderdetails->qty=$product["qty"];
      $orderdetails->price=$product["price"];
      $orderdetails->vat=0;
      $orderdetails->discount=$product["discount"];
      $orderdetails->save();
      
      $stock=new Stock();//1 for sales order      
      $stock->product_id=$product["item_id"];
      $stock->qty=-$product["qty"];
      $stock->transaction_type_id=1;//1 for sales, 2 
      $stock->remark="Order";
      $stock->save();
    }

   
    echo json_encode(["status" => "success"]);
  
  

  }//end function
   
}//end class
?>