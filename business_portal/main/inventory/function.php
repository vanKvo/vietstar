<?php
function getLastSalesinvoice() {
    global $db;
    $result = $db->prepare("SELECT * FROM sales WHERE sales_id = (SELECT MAX(sales_id) FROM sales)");
	$res = $result->execute();
    $row = $result->fetch();
    $invoice_no = $row['invoice_number'];
    $result->closeCursor();
    return $invoice_no;
}

function get_suppliers() {
    global $db;
    $result = $db->prepare("SELECT * FROM supliers");
	$res = $result->execute();
    $suppliers = $result->fetchAll();
    $result->closeCursor();
    return $suppliers;
}

function is_product_exist($product_code) {
    global $db;
    $result = $db->prepare("SELECT COUNT(*) AS num FROM products WHERE product_code = :product_code");
    $result->bindParam(':product_code', trim($product_code));
	$res = $result->execute();
     //Fetch the row that MySQL returned.
    $row = $result->fetch(PDO::FETCH_ASSOC);
    echo "No. of rows: " . $row['num'];
    if ($row['num'] > 0) {
        echo '<br>Product does exist in DB<br>'; 
        return true;
    } else {
        echo '<br>Product does not exist in DB<br>'; 
        return false;
    }
    $result->closeCursor();
}

function createRandomPassword() {
	$current_invoice = getLastSalesinvoice();
	$next_invoice = $current_invoice +1; 
	return $next_invoice;
}

function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}

?>