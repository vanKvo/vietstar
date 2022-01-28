<?php 
require_once '../../connect.php';
require_once '../model/shipping_data.php';
require_once '../model/inventory_data.php';

// Sender
// If no cust_id, then the sender is new customer. Add new customer to DB 
if (clean_input($_GET['cust_id']) == '') {
  $cust_name = clean_input($_GET['cust_name']);
  $cust_phone = clean_input($_GET['cust_phone']);
  $cust_email = clean_input($_GET['cust_email']);
  $cust_address = clean_input($_GET['cust_address']);
  $cust_city = clean_input($_GET['cust_city']);
  $cust_state = clean_input($_GET['cust_state']);
  $cust_zip= clean_input($_GET['cust_zip']);
  if (valid_customer($cust_name, $cust_phone)) {
    add_customer($cust_name, $cust_address , $cust_city, $cust_state, $cust_zip, $cust_email, $cust_phone);
    $customer = get_customer($cust_name, $cust_phone); 
    $cust_id = $customer[0]['customer_id']; // get new customer id 
    echo "New customer id: $cust_id";
  }
// If cust_id exists, it's a returning customer
} else {
  $cust_id = clean_input($_GET['cust_id']);
}

// Recipient
$recipient_id = clean_input($_GET['recipient_id']);
$recipient_name = clean_input($_GET['recipient_name']);
//$recipient_name = $_GET['recipient_name'];
$recipient_address = clean_input($_GET['recipient_address']);
$recipient_phone = clean_input($_GET['recipient_phone']);
/*if (valid_recipient($cust_id, $recipient_name, $recipient_phone)) {
  echo"valid recipient";
}
else echo"recipient exists";
// Add new recipient if applicable
if (isset($recipient_name) && isset($recipient_address) && isset($recipient_phone) && valid_recipient($cust_id, $recipient_name, $recipient_phone)) { // New recipient info is added
  echo "ADD Recipient";
  //add_recipient($recipient_name, $recipient_address, $recipient_phone, $cust_id);
}*/

// Package
$pkg_val = clean_input($_GET['pkg_val']);
$pkg_weight = clean_input($_GET['total_weight']); //total package weight
$send_dt = clean_input($_GET['send_dt']);
$airport_dt = clean_input($_GET['airport_dt']);
$num_pkg = clean_input($_GET['num_pkg']);
$price_per_lb = clean_input($_GET['price_per_lb']);
$location = clean_input($_GET['location']);
$mst = clean_input($_GET['mst']);

// Get packages info
for ($i=0; $i < $num_pkg; $i++) {
  $packages[$i]['pkg_desc'] = clean_input($_GET['pkg_desc'.($i+1)]); // $packages[0][] is empty, 1st element starts from $packages[1][]
  $packages[$i]['pkg_wt'] = clean_input($_GET['pkg_wt'.($i+1)]);
  $packages[$i]['mst'] = $mst;
}

// Payment
$custom_fee = clean_input($_GET['custom_fee']);
$insurance = clean_input($_GET['insurance']);
$instore_sales = clean_input($_GET['instore']);
$pmt_method= clean_input($_GET['pmt']);

$user_id = '1'; // admin

// If some optional values are not set
if (empty($custom_fee)) $custom_fee = 0;
if (empty($insurance)) $insurance = 0;
if (empty($instore_sales)) $instore_sales = 0;
if (empty($pkg_val)) $pkg_val = 0;
if (empty($airport_dt)) $airport_dt = $send_dt;

// Add new shipping ord to the db
if (valid_shipping_ord($mst)) {
  echo "Get inside";
  // Add new recipient
  if (isset($cust_id) && isset($recipient_name) && isset($recipient_address) && isset($recipient_phone) && valid_recipient($cust_id, $recipient_name)) { // New recipient info is added
    echo "ADD new Recipient";
    add_recipient($recipient_name, $recipient_address, $recipient_phone, $cust_id);
    $recipient = get_recipient($cust_id, $recipient_name, $recipient_phone); // customer_id = :v1 AND recipient_name = :v2 AND recipient_phone
    echo "new recipient:" . $recipient[0]['recipient_id'];
    add_shipping_order($mst, $send_dt, $airport_dt, $pkg_weight, $num_pkg, $pkg_val, $custom_fee, $insurance, $pmt_method, $user_id, $location, $cust_id, $recipient[0]['recipient_id'], $price_per_lb);
  }
  // No new recipient is added
  else {
    echo "<br>Add shipord Old recipients<br>";
    add_shipping_order($mst, $send_dt, $airport_dt, $pkg_weight, $num_pkg, $pkg_val, $custom_fee, $insurance, $pmt_method, $user_id, $location, $cust_id, $recipient_id, $price_per_lb);
  }
  $shipping_order = get_shipping_order($mst);
  $shipping_order_id =  $shipping_order[0]['shipping_order_id']; // Get shipping order id of an mst package
  add_package($shipping_order_id, $packages);
}

?>