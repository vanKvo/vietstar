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
	.sticky {
		position: fixed;
		top: 53px;
	}

	.top-sticky {
		position: fixed;
		top: 0;
		width: 100%;
	}
    /* Hidden print header helper */
    #print_header {
        display: none;
        text-align: center;
        margin-bottom: 20px;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
  <?php include 'navfixed.php';?>
	<nav class="navbar-primary sticky">
		<a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
		<ul class="navbar-primary-menu">
            <li><a class="d-flex align-items-center pl-3 text-white text-decoration-none"><span class="fs-4">Sales Report</span></a></li>          
			<li><a href="../index.php" class="nav-link text-white"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
            <li><a href="salereport.php" class="nav-link text-white"> Shipping Sales Report</a></li>    
            <li><a href="inventoryreport.php" class="nav-link text-white active"> Inventory Sales Report</a></li>  	
		</ul>
	</nav><!--/.navbar-primary-->
	<div id="print_content" class="main-content">
	<div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Inventory Sales Report</h4>
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
                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary">Filter</button>
                                      <a href="inventoryreport.php" class="btn btn-secondary">Reset</a>
                                      <a href="javascript:Clickheretoprint()" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
                                      <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          <i class="fa fa-download"></i> Export
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="javascript:exportToExcel('inventorytable', 'Inventory_Sales_Report')"><i class="fa fa-file-excel-o"></i> Excel</a></li>
                                          <li><a class="dropdown-item" href="javascript:exportToPDF('inventorytable', 'Inventory Sales Report')"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
                                        </ul>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div id="print_header">
                        <h2>Vietstar Shipping</h2>
                        <h3>Inventory Sales Report</h3>
                        <p>Period: <?php echo (isset($_GET['from_date']) && $_GET['from_date'] != '') ? $_GET['from_date'] : 'All'; ?> to <?php echo (isset($_GET['to_date']) && $_GET['to_date'] != '') ? $_GET['to_date'] : 'Today'; ?></p>
                        <hr>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover bg-white" id="inventorytable">
                            <thead>
                                <tr>
                                    <th>Invoice number</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
									<th>MST</th>
									<th>Sales Date</th>
									<!--<th>Discount</th>-->

                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php 
                                //$con = mysqli_connect("localhost","root","root", "vietstar_shipping");
                                $total = 0; // total amount

                                if(isset($_GET['from_date']) && isset($_GET['to_date']) && $_GET['from_date'] != '' && $_GET['to_date'] != '')
                                {
                                    $from_date = mysqli_real_escape_string($con, $_GET['from_date']);
                                    $to_date = mysqli_real_escape_string($con, $_GET['to_date']);
                                    $query = "SELECT * FROM sales WHERE DATE(sales_date) >= '$from_date' AND DATE(sales_date) <= '$to_date' ";
                                }
                                else
                                {
                                    $query = "SELECT * FROM sales ORDER BY sales_date DESC LIMIT 100";
                                }
                                $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            $total = $total + $row['sales_amount']; 
                                            ?>
                                            <tr>
                                                <td><?= $row['invoice_number']; ?></td>
                                                <td><?= number_format($row['sales_amount']); ?></td>
                                                <td><?= $row['sales_payment_method']; ?></td>
                                                <td><?= $row['mst']; ?></td>
												<td><?= $row['sales_date']; ?></td>
                                                <!--<td><?= $row['sales_discount']; ?></td>-->

                                            </tr>
                                            <?php
                                        }
                                    }
                                    else if (!$query_run)
                                    {
                                        echo "Query Failed: " . mysqli_error($con);
                                    }
                                    else
                                    {
                                        echo "No Record Found";
                                    }
                            ?>
                                            <tr>
                                                <td>TOTAL</td>
                                                <td><?=number_format($total)?></td>
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
            disp_setting+="scrollbars=yes,width=1000, height=800, left=100, top=25"; 
        
        var header = document.getElementById("print_header").innerHTML;
        var table = document.getElementById("inventorytable").outerHTML;
        
        var docprint=window.open("","",disp_setting); 
        docprint.document.open(); 
        docprint.document.write('<html><head><title>Vietstar Shipping Inventory Report</title>'); 
        docprint.document.write('<link rel="stylesheet" href="../css/lib/bootstrap.css">');
        docprint.document.write('<style>');
        docprint.document.write('body { font-family: sans-serif; padding: 20px; }');
        docprint.document.write('table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px; }');
        docprint.document.write('th, td { border: 1px solid #dee2e6; padding: 10px; text-align: left; }');
        docprint.document.write('th { background-color: #f8f9fa; font-weight: bold; }');
        docprint.document.write('h2, h3 { text-align: center; margin: 5px 0; }');
        docprint.document.write('hr { margin: 20px 0; }');
        docprint.document.write('</style></head><body onLoad="self.print()">');          
        docprint.document.write('<div class="container">');
        docprint.document.write(header);
        docprint.document.write(table); 
        docprint.document.write('</div>');
        docprint.document.write('</body></html>'); 
        docprint.document.close(); 
        docprint.focus(); 
        }

    function exportToExcel(tableID, filename) {
        var table = document.getElementById(tableID);
        var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet1"});
        XLSX.writeFile(wb, filename + ".xlsx");
    }

    function exportToPDF(tableID, title) {
        const { jsPDF } = window.jspdf;
        var doc = new jsPDF('p', 'pt', 'a4');
        
        doc.text(title, 40, 40);
        doc.setFontSize(10);
        var dateInfo = "Period: " + (document.querySelector('input[name="from_date"]').value || 'All') + " to " + (document.querySelector('input[name="to_date"]').value || 'Now');
        doc.text(dateInfo, 40, 60);

        doc.autoTable({
            html: '#' + tableID,
            startY: 80,
            theme: 'grid',
            headStyles: { fillColor: [41, 128, 185], textColor: 255 }
        });
        
        doc.save(title.replace(/ /g, '_') + ".pdf");
    }
     </script>
</body>
</html>