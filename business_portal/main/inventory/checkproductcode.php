<?php
	include('../connect.php');
	if(isset($_GET['product_code'])){
		$product_code=$_GET['product_code'];
		$stmt = $db->prepare("SELECT COUNT(*) as num FROM products WHERE product_code= :product_code");
		$stmt->bindParam(':product_code', $product_code);
		$stmt->execute();
		//$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$row = $stmt->fetch();
		$stmt->closeCursor();
		$data['num'] = $row['num'];
	} else {
		$data['error'] = 'Product code is not set';
	}
	echo json_encode($data);
?>