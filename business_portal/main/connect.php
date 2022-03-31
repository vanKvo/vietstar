<?php
//echo 'connect.php file';
  $dsn = 'mysql:host=localhost;dbname=vietstar_shipping';
  $username = 'root';
  $password = 'root';

  /*$dsn = 'mysql:host=ls-02dbcb8e5a15402493c2737ee2f3e1cfcc129082.c16ul9zk1azh.us-east-1.rds.amazonaws.com;dbname=vietstar_shipping';
  $username = 'dbmasteruser';
  $password = '~P1>?0d3_}#KaAen&*w;$fh=$x4D$T-[';*/

  $con = mysqli_connect("localhost","root","root","vietstar_shipping"); // $con is used for php webpages in customers and sales_reports folder

  /**  Create DB Connection **/
  try {
    //$db = new PDO($dsn, $username);
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error = "Database Error: ";
    $error .= $e->getMessage();
    exit();
}

  
?>	
