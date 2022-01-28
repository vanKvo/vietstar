<?php
session_start();
include('../connect.php');
$a = $_POST['product_code'];
$b = $_POST['product_name'];
$c = $_POST['exdate'];
$d = $_POST['unit_price'];
$e = $_POST['supplier'];
$f = $_POST['qty_onhand'];
$g = $_POST['unit_cost'];
$h = $_POST['profit'];
$i = $_POST['product_category'];
$j = $_POST['date_arrival'];
$k = $_POST['qty_supplied'];
echo 'Hello 2';
// query
$sql = "INSERT INTO products (product_code,product_name,expiry_date,unit_price,supplier,qty_onhand,unit_cost,profit,product_category,date_arrival,qty_supplied) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k)";
$q = $db->prepare($sql);
$res=$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$i,':j'=>$j,':k'=>$k));
header("location: products.php");
/*if ($q) {
  echo'Success';
} else {
  echo 'Fails';
}*/

?>