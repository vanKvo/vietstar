<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM purchase WHERE purchase_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditpurchase.php" method="post">
<center><h4><i class="icon-edit icon-large"></i> Edit Purchase</h4></center>
<hr>
<div id="ac">
<input type="hidden" name="purchase_id" value="<?php echo $id; ?>" />
<span>Cost of Product : </span><input type="text" style="width:265px; height:30px;" name="cost" value="<?php echo $row['purchase_cost']; ?>" /><br>
<span>Quantity of Product : </span><input type="text" style="width:265px; height:30px;" name="qty" value="<?php echo $row['purchase_qty']; ?>" /><br>

<div style="float:right; margin-right:10px;">

<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
</div>
</div>
</form>
<?php
}
?>