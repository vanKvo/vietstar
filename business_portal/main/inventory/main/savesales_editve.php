<?php
session_start();
include('../connect.php');
$v1 = $_POST['invoice'];
$v2 = $_POST['cashier'];
$v3 = $_POST['ptype'];

if (empty($_POST['cname'])) $v4 = '-';
else $v4 = $_POST['cname'];;

$v5 = $_POST['total_payment'];

if (empty($_POST['discount'])) $v6 = 0;
else $v6 = $_POST['discount'];
$v7 = $_POST['date'];

//$v7 = '2022-11-21'; // Mysql format date(y-m-d) in PHP
$v8 = $_POST['amount'];
//$v9 = $_POST['profit'];
echo "$v1 | $v2 |$v3 |$v4 |$v5 |$v6 |$v7 |$v8 |";
//if($d=='credit') {
//$f = $_POST['due'];
//$sql = "INSERT INTO sales (invoice_number,cashier,sales_payment_method,sales_amount,sales_profit,sales_custname,sales_total_payment,sales_discount) VALUES (:v1,:v2,:v3,:v4,:v5,:v6,:v7,:v8,:v9)";
echo "<br>Start insert sales<br>";
$query1 = 'INSERT INTO `sales`(`invoice_number`, `cashier`, `sales_payment_method`, `sales_custname`, `sales_total_payment`, `sales_discount`, `sales_date`, `sales_amount`) VALUES (:v1,:v2,:v3,:v4,:v5,:v6,:v7,:v8)';
$stmt1 = $db->prepare($query1);
$res1 = $stmt1->execute(array(':v1'=>$v1,':v2'=>$v2,':v3'=>$v3,':v4'=>$v4,':v5'=>$v5,':v6'=>$v6,':v7'=>$v7,':v8'=>$v8));
if ($res1) echo '<br>Success<br>';
else echo '<br>Fail<br>';
echo "<br>End insert sales<br>";

// Get sales id first
echo "<br>Start get sales id<br>";
$query2 = 'SELECT * FROM sales WHERE invoice = :invoice';
$stmt2 = $db->prepare($query2);
$stmt2->bindParam(':invoice', $v1);
$res2 = $stmt2->execute();
$sales = $stmt2->fetchAll();
$sales_id = sales[0]['sales_id'];
if ($res2) echo '<br>Success<br>';
else echo '<br>Fail<br>';
echo "<br>End get sales id<br>";

// Insert sales id into line items in sales order table
echo "<br>Start get sales orders<br>";
$query3 = 'SELECT * FROM sales_orders WHERE invoice = :invoice';
$stmt3 = $db->prepare($query3);
$stmt3->bindParam(':invoice', $v1);
$res3 = $stmt3->execute();
$line_items = $stmt2->fetchAll();
if ($res3) echo '<br>Success<br>';
else echo '<br>Fail<br>';
echo "<br>End get sales orders<br>";

echo "<br>Start insert sales id in line items<br>";
for ($i = 0; $i < count($line_items); $i++) {
  $query4 = 'UPDATE sales_order 
  SET sales_id = :sales_id 
  WHERE invoice = :invoice';
  $stmt4 = $db->prepare($query4);
  $res4 = $stmt4->execute(array()
    ':sales_id ' => $sales_id;
    ':invoice' => $v1
  ));

}
if ($res4) echo '<br>Success<br>';
else echo '<br>Fail<br>';

echo "<br>End insert sales id in line items<br>";
exit();
//header("location: preview.php?invoice=$v1");
?>