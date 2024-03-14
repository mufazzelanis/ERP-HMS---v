<?php

class PurchaseApi{

  static function save($data){  

   
    $purchase_date=$data["purchase_date"];
    $delivery_date=$data["delivery_date"];   

    $purchase_date=date("Y-m-d",strtotime($purchase_date));//convert date into mysql format
    $delivery_date=date("Y-m-d",strtotime($delivery_date));//convert date into mysql format

    $products=$data["products"];
       
    $purchase=new Purchase();  
		$purchase->supplier_id=$data["supplier_id"];
		$purchase->purchase_date=$purchase_date;
		$purchase->delivery_date=$delivery_date;
		$purchase->shipping_address=$data["shipping_address"];
		$purchase->purchase_total=$data["purchase_total"];		
		$purchase->remark=$data["remark"];
		$purchase->status_id=1;
		$purchase->discount=$data["discount"];
		$purchase->vat=$data["vat"];

    $purchase_id=$purchase->save();  
    
    $now=date("Y-m-d H:i:s"); 

    foreach($products as $product){
      $purchasedetails=new PurchaseDetail();
      
      $purchasedetails->purchase_id=$purchase_id;
      $purchasedetails->product_id=$product["item_id"];
      $purchasedetails->qty=$product["qty"];
      $purchasedetails->price=$product["price"];
      $purchasedetails->vat=0;
      $purchasedetails->discount=$product["discount"];
      $purchasedetails->save();
      
      $stock=new Stock();//1 for sales order      
      $stock->product_id=$product["item_id"];
      $stock->qty=$product["qty"];
      $stock->transaction_type_id=3;//3 for purchase
      $stock->remark="Purchase";
      $stock->save();
    }

   
    echo json_encode(["status" => "success"]);
  
  

  }//end function
   
}//end class
?>