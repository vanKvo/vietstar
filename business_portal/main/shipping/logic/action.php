<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';

global $db;

$received_data = json_decode(file_get_contents("php://input"));
$data = array();


/** Fetch data of a record for Edit table in Paid Shipping Orders */
if($received_data->action == 'fetchShippingOrd')
{
 $query = "
 SELECT * FROM tbl_sample 
 WHERE id = '".$received_data->id."'
 ";
 $query = "SELECT * FROM shipping_order so
 JOIN customer c ON so.customer_id = c.customer_id
 JOIN recipient r ON so.recipient_id = r.recipient_id
 WHERE shipping_order_id = '".$received_data->id."' ";
 $statement = $db->prepare($query);
 $statement->execute();
 //$result = $statement->fetchAll();
 $data = $statement->fetchAll();

 echo json_encode($data);
 
}

/** Update data of a record for Edit table in Paid Shipping Orders */
if($received_data->action == 'update')

{
 $data = array(
  /*':first_name' => $received_data->firstName,
  ':last_name' => $received_data->lastName,*/
  ':send_date' => $received_data->send_date,
  ':departure_date' => $received_data->departure_date,
  ':note' => $received_data->note,
  ':id'   => $received_data->hiddenId
 );

 $query = "
 UPDATE shipping_order
 SET send_date = :send_date, 
 airport_delivery_date = :departure_date,
 note = :note
 WHERE shipping_order_id = :id
 ";

 $statement = $db->prepare($query);

 $statement->execute($data);

 $output = array(
  'message' => 'Data Updated'
 );

 echo json_encode($output);
}


if($received_data->action == 'fetchall')
{
 $query = "
 SELECT * FROM tbl_sample 
 ORDER BY id DESC
 ";
 $statement = $db->prepare($query);
 $statement->execute();
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}


/*if($received_data->action == 'insert')
{
 $data = array(
  ':first_name' => $received_data->firstName,
  ':last_name' => $received_data->lastName
 );

 $query = "
 INSERT INTO tbl_sample 
 (first_name, last_name) 
 VALUES (:first_name, :last_name)
 ";

 $statement = $db->prepare($query);

 $statement->execute($data);

 $output = array(
  'message' => 'Data Inserted'
 );

 echo json_encode($output);
}*/


?>