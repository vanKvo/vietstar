<?php
// configuration
include('../connect.php');

// new data
$product_id = $_POST['product_id'];
$v1 = $_POST['product_code'];
$v2 = $_POST['product_category'];
$v3 = $_POST['product_name'];
$v4 = $_POST['exdate'];
$v5 = $_POST['unit_price'];
$v6 = $_POST['supplier'];
$v7 = $_POST['qty_onhand'];
$v8 = $_POST['unit_cost'];
$v9 = $_POST['profit'];
$v10 = $_POST['date_arrival'];
$v11 = $_POST['qty_supplied'];
$v12 = $_POST['product_location'];
echo "<br>$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12, $product_id<br>";
// query
/*$sql = "UPDATE products 
        SET product_code=?, product_category=?, product_name=?, expiry_date=?, unit_price=?, supplier=?, qty_onhand=?, unit_cost=?, profit=?, date_arrival=?, qty_supplied=?, product_location=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$res = $q->execute(array($a,$z,$b,$c,$d,$e,$f,$g,$h,$i,$j,$product_id, $k));*/
$sql = 'UPDATE products 
        SET product_code=:v1, product_category=:v2, product_name=:v3, expiry_date=:v4, unit_price=:v5, supplier=:v6, qty_onhand=:v7, unit_cost=:v8, profit=:v9, date_arrival=:v10, qty_supplied=:v11, product_location=:v12
		WHERE product_id=:product_id';
$stmt = $db->prepare($sql);
$res = $stmt->execute(array(
    ':v1' => $v1,
    ':v2' => $v2,
    ':v3' => $v3,
    ':v4' => $v4,
    ':v5' => $v5,
    ':v6' => $v6,
    ':v7' => $v7,
    ':v8' => $v8,
    ':v9' => $v9,
    ':v10' => $v10,
    ':v11' => $v11,
    ':v12' => $v12,
    ':product_id' => $product_id
   ));
if ($res) {
    echo "<br>Success<br>";
} else echo "<br>Fail<br>";

header("location: products.php");

?>