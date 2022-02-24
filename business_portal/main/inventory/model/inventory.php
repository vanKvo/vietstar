<?php
function getLastSalesInvoice() {
	global $db;
  $query= 'SELECT * FROM sales WHERE sales_id = (SELECT MAX(sales_id) FROM sales)';
  $stmt = $db->prepare($query);
  $stmt->execute();
  $sales = $stmt->fetch();
  $last_invoice_number = $sales['invoice_number'];
  $stmt->closeCursor(); 
  return $last_invoice_number;
}
?>