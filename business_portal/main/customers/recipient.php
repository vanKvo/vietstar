<?php 
include('../connect.php');
require_once('../../auth.php');
$position=$_SESSION['SESS_POSITION'];
$name=$_SESSION['SESS_NAME'];

ini_set('display_errors',1);
error_reporting(E_ALL);
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
	tr:nth-child(even) {background-color: #f2f2f2
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
            <li> <a class="d-flex align-items-center pl-3 text-white text-decoration-none"><span class="fs-4">Customers</span></a></li>
			<li><a href="../index.php" class="nav-link text-white"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li>             
			<li><a href="customer.php" class="nav-link text-white active">Customer List</a></li>		
		</ul>
	</nav><!--/.navbar-primary-->
     <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                <div class="card-header">
                        <h4>Recipients</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
 
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Recipient name</th>
                                    <th>address</th>
                                    <th>phone</th>
                                    <th>email</th>
 
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                    if(isset($_GET['customer_id']))
                                    {
                                        $customer_id = $_GET['customer_id'];
                                        $query = "SELECT * FROM customer c JOIN  recipient r ON c.customer_id = r.customer_id WHERE c.customer_id = $customer_id";
                                        //$query = "SELECT * FROM customer WHERE customer_id=$customer_id";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $items['recipient_id']; ?></td>
                                                    <td><?= $items['recipient_name']; ?></td>
                                                    <td><?= $items['recipient_address']; ?></td>
                                                    <td><?= $items['recipient_phone']; ?></td>
                                                    <td><?= $items['recipient_email']; ?></td>
                                                    <td><a href="reedit.php?recipient_id=<?php echo $items['recipient_id']?>&customer_id=<?php echo $customer_id?>">Edit</a></td>
                

                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




