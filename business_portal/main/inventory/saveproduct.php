<?php
session_start();
include('../connect.php');
include('function.php');
require_once('auth.php');

$v1 = strtoupper(trim($_POST['product_code']));
$v2 = $_POST['product_category'];
$v3 = $_POST['product_name'];
$v4 = $_POST['unit_price'];
//$v5 = $_POST['supplier'];
if (!empty($v6)) $v6 = $_POST['qty_onhand'];
else $v6 = 0;
$v7 = $_POST['product_location'];

echo "$v1, $v2, $v3, $v4, $v6, $v7";

if (is_product_exist($v1)) { // Update product quantity
  echo 'PRODUCT EXISTS - UPDATE QTY';
  $sql = "UPDATE `products` 
  SET `qty_onhand`= qty_onhand + :v6  WHERE product_code = :v1";
  $q = $db->prepare($sql);
  $res=$q->execute(array(':v1'=>$v1,':v6'=>$v6));
  if ($res) {
    echo'update Product qty Success';
  } else {
    echo 'update Product qty Fails';
  }

} else { // Insert new product to DB
  // query
  $sql = "INSERT INTO `products`(`product_code`, `product_category`, `product_name`, `unit_price`, `qty_onhand`, `product_location`) VALUES (:v1,:v2,:v3,:v4,:v6,:v7)";
  $q = $db->prepare($sql);
  $res=$q->execute(array(':v1'=>$v1,':v2'=>$v2,':v3'=>$v3,':v4'=>$v4,':v6'=>$v6,':v7'=>$v7));
  if ($res) {
    echo'Insert new Product Success';
  } else {
    echo 'Insert new Product Fails';
  }
  
}

header("location: products.php");

?>