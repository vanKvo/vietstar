<?php
require_once('auth.php');
$user_id=$_SESSION['SESS_MEMBER_ID'];
$position=$_SESSION['SESS_POSITION'];
$name=$_SESSION['SESS_NAME'];

include('../connect.php');
$v1 = htmlspecialchars($_POST['invoice'] ?? '');
$v2 = strtolower(htmlspecialchars($_POST['ptype'] ?? ''));
if (empty($_POST['cname'])) {
    $v3 = 'NA';
} else {
    $v3 = htmlspecialchars($_POST['cname']);
}

$v4 = (float)($_POST['cust_payment'] ?? 0);

if (empty($_POST['discount'])) {
    $v5 = 0;
} else {
    $v5 = (float)$_POST['discount'];
}
$v6 = htmlspecialchars($_POST['date'] ?? date('Y-m-d'));
$v7 = (float)($_POST['amount'] ?? 0);
$v8 = '0';
$v9 = (int)$user_id; 


echo "Invoice: $v1 | Ptype: $v2 | Cname: $v3 | CPayment: $v4 |Total payment: $v5 |Sales Date: $v6 | Amt: $v7 |MST: $v8 | UserId: $v9  ";
$sql = 'INSERT INTO `sales`(`invoice_number`,`sales_payment_method`, `sales_custname`, `sales_cust_payment`, `sales_discount`, `sales_date`, `sales_amount`, `mst`, `user_id`) VALUES (:v1,:v2,:v3,:v4,:v5,:v6,:v7,:v8,:v9)';
$q = $db->prepare($sql);
$res = $q->execute(array(':v1'=>$v1,':v2'=>$v2,':v3'=>$v3,':v4'=>$v4,':v5'=>$v5,':v6'=>$v6,':v7'=>$v7,':v8'=>$v8,':v9'=>$v9));

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
echo "<br>Sales id: $sales_id<br>";
echo "<br>End get sales id<br>";

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