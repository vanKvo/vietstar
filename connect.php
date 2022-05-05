<?php
//echo 'connect.php file';
  $dsn = 'mysql:host=localhost;dbname=vietstar_shipping';
  $username = 'root';
  $password = 'root';

  /*$dsn = 'mysql:host=ls-a9bf68472683f6dbeaf64fcf64ce7c81bf5fa6d6.cv9qb4mlh1sf.us-east-1.rds.amazonaws.com;dbname=vietstar_shipping';
  $username = 'dbmasteruser';
  $password = 'P2TtK([idwq^vMLbU=$dE4l,p0)$=3O=';*/


  $con = mysqli_connect("localhost","root","root","vietstar_shipping"); // $con is used for php webpages in customers and sales_reports folder
  //$con = mysqli_connect("ls-a9bf68472683f6dbeaf64fcf64ce7c81bf5fa6d6.cv9qb4mlh1sf.us-east-1.rds.amazonaws.com","dbmasteruser","P2TtK([idwq^vMLbU=".'$dE4l'.",p0)$=3O=","vietstar_shipping"); 

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