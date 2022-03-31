<?php 
include('../connect.php');
require_once('../../auth.php');
$position=$_SESSION['SESS_POSITION'];
$name=$_SESSION['SESS_NAME'];
?>
<!DOCTYPE>
<html>
<head>
<title>Dashboard</title>
<meta name ="viewport" content ="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/lib/bootstrap.css">
<link rel="stylesheet" href="../css/lib/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/styles.css">
<link rel="stylesheet" type="text/css" href="../css/maindashboard.css">
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<script src="js/scripts.js"></script>
<style>
	table{
		border-collapse: collapse;
		width: 100%;
		color: #588c7e;
		font-family: monospace;
		font-size : 16px;
		text-align: left;
	}
	th{
		background-color: #588c7e;
		color:black;
	}
	tr:nth-child(even) {
        background-color: #f2f2f2;
	}
    tr:nth-child(even) .total_row {
        background-color: #202020;
    }
	.sticky {
		position: fixed;
		top: 53 px;
	}

	.top-sticky {
		position: fixed;
		top: 0;
		width: 100%;
}
</style>	
</head>
<body>
  <?php include 'navfixed.php';?>
	<nav class="navbar-primary sticky">
		<a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
		<ul class="navbar-primary-menu">
            <li><a class="d-flex align-items-center pl-3 text-white text-decoration-none"><span class="fs-4">Sales Report</span></a></li>          
			<li><a href="../index.php" class="nav-link text-white"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
            <li><a href="salereport.php" class="nav-link text-white active"> Shipping Sales Report</a></li>    
            <li><a href="inventoryreport.php" class="nav-link text-white"> Inventory Sales Report</a></li>  
		</ul>
	</nav><!--/.navbar-primary-->
	<div id="print_content" class="main-content">
	<div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Shipping Sales Report</h4>
                    </div>
                    <div class="card-body">
                    
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary">Filter</button>
                                      <!--<button onclick="window.print()" class= "btn btn-primary">Print</button>-->
                                      <a href="javascript:Clickheretoprint()" class="btn btn-primary"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-borderd">
                            <thead>
                                <tr>
                                    <th>MST</th>
                                    <th>Payment Method</th> 
                                    <th>Amount</th>        
									<th>Total Weight</th>
									<th>Number of Package</th>
                                    <th>Custom Fee</th>
									<th>Taxed Items</th>
									<th>Send To</th>
									<th>Send Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php 
                                //$con = mysqli_connect("localhost","root","root", "vietstar_shipping");
                                $total_amount = 0;
                                $total_tax = 0;
                                $total_weight = 0;
                                $num_pkg = 0;

                                if(isset($_GET['from_date']) && isset($_GET['to_date']))
                                {
                                    $from_date = $_GET['from_date'];
                                    $to_date = $_GET['to_date'];

                                    $query = "SELECT * FROM shipping_order WHERE send_date BETWEEN '$from_date' AND '$to_date' ";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            $total_amount = $total_amount + $row['amount'];
                                            $total_tax =  $total_tax +  $row['custom_fee'];
                                            $total_weight = $total_weight + $row['total_weight'];
                                            $num_pkg =  $num_pkg + $row['num_of_packages'];
                                            ?>
                                            <tr>
                                                <td><?= $row['mst']; ?></td>
                                                <td><?= $row['payment_method']; ?></td>
                                                <td><?= number_format($row['amount']); ?></td>
												<td><?= number_format($row['total_weight']); ?></td>
												<td><?= number_format($row['num_of_packages']); ?></td>
                                                <td><?= number_format($row['custom_fee']); ?></td>
												<td><?= $row['custom_fee_taxed_item']; ?></td>
												<td><?= $row['location']; ?></td>
												<td><?= $row['send_date']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "No Record Found";
                                    }
                                }
                            ?>
                                            <tr class="total_row">
                                                <td>TOTAL</td>
                                                <td></td>
                                                <td><?=number_format($total_amount)?></td>
												<td><?=number_format($total_weight)?></td>
												<td><?=number_format($num_pkg)?></td>
                                                <td><?=number_format($total_tax)?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script>

     function Clickheretoprint() { 
        var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
            disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
        var content_vlue = document.getElementById("print_content").innerHTML; 
        
        var docprint=window.open("","",disp_setting); 
        docprint.document.open(); 
        docprint.document.write('<html><head><title>Vietstar Shipping</title><link rel="stylesheet" type="text/css" href="../../css/shipping_invoice.css"><link rel="stylesheet" href="../../css/lib/bootstrap.css">'); 
        docprint.document.write('<style>table{ border-collapse: collapse;width: 100%; font-family: monospace;font-size : 18px; text-align: left;} th{color:black;}tr:nth-child(even) {background-color: #f2f2f2;}</style>');
        docprint.document.write('</head><body onLoad="self.print()">');          
        docprint.document.write(content_vlue); 
        docprint.document.write('</body></html>'); 
        docprint.document.close(); 
        docprint.focus(); 
    }
    </script>
</body>
</html>