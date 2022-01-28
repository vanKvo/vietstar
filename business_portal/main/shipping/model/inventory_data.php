<?php 
//echo "<br>Hello inventory_data.php<br>";

function get_products() {
  //echo "Start get_products() <br>";
  global $db;
  $query = 'SELECT * FROM products';
  $stmt = $db->prepare($query);
  $stmt->execute();
  $products = $stmt->fetchAll();
  $stmt->closeCursor(); 
  //echo "End get_products() <br>";
  return $products;
}

?>