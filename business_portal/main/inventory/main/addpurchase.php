<?php 
include('../connect.php');
include('function.php');
$finalcode=createRandomPassword();
?>
<html>
<head>
<title>Vietstar_Shipping</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/navbar.css" media="screen" rel="stylesheet" type="text/css" />
<style type="text/css">
.well li {
	line-height: 20px;
	list-style: none;
	padding-bottom: 10px;
}
</style>
<!--sa poip up-->
<script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>
<script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
</script>	
</head>
<body>
<?php include('navfixed.php');?>
<div class="container-fluid">
  <div class="row-fluid">
	<div class="span2">
          <div class="well sidebar-nav">
              <ul class="nav nav-list">
              <li><a href="index.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
			<li class="active"><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i> Sales</a>  </li>             
			<li><a href="products.php"><i class="icon-list-alt icon-2x"></i> Inventory</a> </li>
			<li><a href="supplier.php"><i class="icon-group icon-2x"></i> Suppliers</a> </li>
			<li><a href="purchase.php"><i class="icon-group icon-2x"></i> Purchase</a> </li>     
			<li><a href="../index.php"><i class="icon-off icon-large"></i> Log Out</a></li>                                             
			<br><br><br><br><br><br>
			<li>
			 <div class="hero-unit-clock">
		
			<form name="clock">
			<font color="white">Time: <br></font>&nbsp;<input style="width:150px;" type="text" class="trans" name="face" value="" disabled>
			</form>
			  </div>
			</li>		
				</ul>    		
          </div><!--/.well -->
        </div><!--/span-->
	<div class="span10">
		<div class="contentheader">
			 Add Purchase
			</div>
			<ul class="breadcrumb">
			</ul>
			<div style="margin-top: -19px; margin-bottom: 21px;">
				<a  href="purchase.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
			</div>											
			<form action="savepurchase.php" method="post">					
				<label>Scan UPC </label>
				<select name="Product_id" style="width:650px;" class="chzn-select" required>
					<option></option>
						<?php
							$result = $db->prepare("SELECT * FROM products");
							$result->execute();
							for($i=0; $row = $result->fetch(); $i++){
						?>
							<option value="<?php echo $row['product_id'];?>"><?php echo $row['product_code']; ?> | <?php echo $row['product_name']; ?> | Qty Onhand: <?php echo $row['qty_onhand']; ?></option>
						<?php
									}
						?>
				</select>
				<label>Suppliers Name</label>
				<select name="supplier_id" style="width:650px;" class="chzn-select" required>
				<option></option>
					<?php
					$result = $db->prepare("SELECT * FROM supliers");
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
					?>
						<option value="<?php echo $row['suplier_id'];?>"><?php echo $row['suplier_name']; ?> </option>
					<?php
								}
					?>
				</select>
				<label>Cost of Product ($):</label>
				<input type="text" style="width:265px; height:30px;" name="Cost_Product" placeholder="0.00"/><br>
				<label>Quantity of Product: </label>
				<input type="number" style="width:265px; height:30px;" name="Quantity_Product" placeholder="0"/><br>
				<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
			</form>
</div>
</div><!--row-fluid-->
</div><!--container-fluid-->
</body>
<?php include('footer.php');?>
</html>