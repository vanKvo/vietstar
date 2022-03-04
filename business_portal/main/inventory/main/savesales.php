<?php
session_start();
include('../connect.php');
$v1 = $_POST['invoice'];
//$v2 = $_POST['cashier'];
$v3 = $_POST['ptype'];

if (empty($_POST['cname'])) $v4 = 'NO_NAME';
else $v4 = $_POST['cname'];;

$v5 = $_POST['cust_payment'];

if (empty($_POST['discount'])) $v6 = 0;
else $v6 = $_POST['discount'];
$v7 = $_POST['date'];

//$v7 = '2022-11-21'; // Mysql format date(y-m-d) in PHP
$v8 = $_POST['amount'];
$v9 = 0;
echo "$v1 | $v2 |$v3 |$v4 |Total payment: $v5 |$v6 |$v7 |$v8  ";
$sql = 'INSERT INTO `sales`(`invoice_number`,`sales_payment_method`, `sales_custname`, `sales_cust_payment`, `sales_discount`, `sales_date`, `sales_amount`, `sales_profit`) VALUES (:v1,:v3,:v4,:v5,:v6,:v7,:v8,:v9)';
$q = $db->prepare($sql);
$res = $q->execute(array(':v1'=>$v1,':v3'=>$v3,':v4'=>$v4,':v5'=>$v5,':v6'=>$v6,':v7'=>$v7,':v8'=>$v8,':v9'=>$v9));

if ($res) echo '<br>Success<br>';
else echo '<br>Fail<br>';

// Get sales id first
echo "<br>Start get sales id<br>";
$query2 = 'SELECT * FROM sales WHERE invoice_number = :invoice';
$stmt2 = $db->prepare($query2);
$stmt2->bindParam(':invoice', $v1);
$res2 = $stmt2->execute();
$sales = $stmt2->fetchAll();
$sales_id = $sales[0]['sales_id'];

// Update sales id for line items in sales order table
echo "<br>Start update sales orders<br>";
$query3 = "UPDATE sales_order SET sales_id = :sales_id WHERE invoice = :invoice";
$stmt3 = $db->prepare($query3);
$res3 = $stmt3->execute(array(
   ':sales_id' => $sales_id,
   ':invoice' => $v1
  ));
$res3 = $stmt3->execute();
if ($res3) echo '<br>Success<br>';
else echo '<br>Fail<br>';
echo "<br>End update sales orders<br>";
header("location: preview.php?invoice=$v1");
exit();

?>