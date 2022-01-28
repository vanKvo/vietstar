<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';
require_once '../model/inventory_data.php';

      $recipient = get_recipient('2', 'Phuong Dang', '5718889900'); 
      echo "new recipient:" . $recipient[0]['recipient_id'];
?>
