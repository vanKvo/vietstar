<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';

//$connect = new PDO("mysql:host=localhost;dbname=vietstar_shipping", "root", "root");

global $db;

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

if($received_data->query != '')
{
	$query = "
	SELECT * FROM shipping_order so
  JOIN customer c ON so.customer_id = c.customer_id
	WHERE mst LIKE '%".$received_data->query."%' 
	OR cust_name LIKE '%".$received_data->query."%' 
	ORDER BY mst DESC
	";
  /*$query = "
	SELECT * FROM tbl_sample 
	WHERE first_name LIKE '%".$received_data->query."%' 
	OR last_name LIKE '%".$received_data->query."%' 
	ORDER BY id DESC
	";*/
}
else
{
	$query = "
  SELECT * FROM shipping_order so
  JOIN customer c ON so.customer_id = c.customer_id
	ORDER BY mst DESC
	";
  /*$query = "
	SELECT * FROM tbl_sample 
	ORDER BY id DESC
	";*/
}

$statement = $db->prepare($query);

$statement->execute();
/*if ($res) echo '<br>Success<br>';
else echo '<br>Fail<br>';*/
$statement->execute();
while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$data[] = $row;
}

echo json_encode($data);

?>