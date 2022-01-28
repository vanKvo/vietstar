<?php
session_start();
include('../connect.php');
$invoice = $_POST['invoice'];
$product_id = $_POST['product_id'];
$qty_picked = $_POST['qty_picked'];
$payment_method = $_POST['id'];
$date = $_POST['date'];
$discount = $_POST['discount'];

// Get info of a product from products table
$result = $db->prepare("SELECT * FROM products WHERE product_id = :product_id");
$result->bindParam(':product_id', $product_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
    $unit_profit = $row['profit'];
    $unit_price = $row['unit_price'];
/*$code=$row['product_code'];
$gen=$row['gen_name'];
$name=$row['product_name'];
$asasa=$row['price'];
$code=$row['product_code'];
$gen=$row['gen_name'];
$name=$row['product_name'];*/
}

// Update qty onhand in products
$sql = "UPDATE products 
        SET qty_onhand = qty_onhand-?
		WHERE product_id = ?";
$q = $db->prepare($sql);
$q->execute(array($qty_picked,$product_id));

// Insert a sales order of a product
//$fffffff=$asasa-$discount;
//$profit=$p*$c;
$sales_order_amount = $qty_picked * $unit_price;
$total_profit = $qty_picked * $unit_profit;
// query
$sql = "INSERT INTO sales_order (invoice,product_id,qty_picked,sales_order_amount,sales_order_profit) VALUES (:v1,:v2,:v3,:v4,:v5)";
$q = $db->prepare($sql);
$q->execute(array(':v1'=>$invoice,':v2'=>$product_id,':v3'=>$qty_picked,':v4'=>$sales_order_amount,':v5'=>$total_profit));
header("location: sales.php?id=$payment_method&invoice=$invoice");


?>