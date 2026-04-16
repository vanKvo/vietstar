<html>
<head>
<title>Checkout</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
</head>
<body onLoad="document.getElementById('cname').focus();">
<form action="savesales.php" method="post">
<div id="ac">
<center><h4><i class="icon icon-money icon-large"></i> Payment</h4></center><hr>
<input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>" />
<input type="hidden" name="invoice" value="<?php echo htmlspecialchars($_GET['invoice'] ?? ''); ?>" />
<input type="hidden" name="amount" id="amount" value="<?php echo htmlspecialchars($_GET['total_amount'] ?? '0'); ?>" />
<input type="hidden" name="ptype_hidden" value="<?php echo htmlspecialchars($_GET['pmt_method'] ?? ''); ?>" />
<input type="hidden" name="cashier" value="<?php echo htmlspecialchars($_GET['cashier'] ?? ''); ?>" />
<input type="hidden" name="profit" value="<?php echo htmlspecialchars($_GET['total_profit'] ?? '0'); ?>" />
<center>
	<label> Enter Customer Name </label>
<input type="text" size="25" value="" name="cname" id="cname" class="" autocomplete="off" placeholder="Name" style="width: 268px; height:30px;" />
	<br><br>
	<label> Payment method </label>
	<input type="text" list="payment_methods" name="ptype" style="width: 268px; height:30px;" placeholder="Select or type..." required value="<?php echo htmlspecialchars($_GET['pmt_method'] ?? ''); ?>">
	<datalist id="payment_methods">
		<option value="cash">
		<option value="credit">
		<option value="zelle">
		<option value="venmo">
	</datalist>
	<br><br>
<label> Customer payment ($)</label>
<input type="text" size="25" value="<?php echo htmlspecialchars($_GET['total_amount'] ?? '0'); ?>" name="cust_payment" id="cust_payment" placeholder="0.00" style="width: 268px; height:30px;" required/>
<br><br>
<button class="btn btn-success btn-block btn-large" style="width:267px;">Submit</button>
</center>
</div>
</form>
</body>
</html>