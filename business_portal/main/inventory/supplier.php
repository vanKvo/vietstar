<?php 
include('../connect.php');
include('function.php');
require_once('auth.php');
$position=$_SESSION['SESS_POSITION'];
$name=$_SESSION['SESS_NAME'];
$finalcode=createRandomPassword();
?>
<html>
<head>
    <title>Vietstar_Shipping - Suppliers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/lib/bootstrap.css">
    <link rel="stylesheet" href="../css/lib/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/maindashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <style>
        .sticky { position: fixed; top: 53px; }
        .top-sticky { position: fixed; top: 0; width: 100%; }
        .modal-body form { width: 100%; }
        .modal-body form input { width: 100% !important; margin-bottom: 10px; }
    </style>
</head>

<body>
<?php include('navfixed.php');?>
<nav class="navbar-primary sticky">
    <a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
    <ul class="navbar-primary-menu">
        <li> <a class="d-flex align-items-center pl-3 text-white text-decoration-none"><span class="fs-4">Inventory</span></a></li>
        <li><a href="../index.php" class="nav-link text-white"><i class="icon-dashboard icon-2x"></i> Dashboard  </a></li> 
        <li><a href="products.php" class="nav-link text-white"><i class="icon-list-alt icon-2x"></i> Inventory</a></li>    
        <li><a href="purchase.php" class="nav-link text-white"><i class="icon-group icon-2x"></i> Store Orders </a> </li>     
        <li><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>" class="nav-link text-white"><i class="icon-shopping-cart icon-2x"></i> Sales </a></li>             
        <li><a href="supplier.php" class="nav-link text-white active"><i class="icon-group icon-2x"></i> Suppliers</a></li> 
    </ul>             
</nav>

<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="icon-group"></i> Suppliers</h4>
                    <button class="btn btn-primary custom-btn ajax-modal-btn" data-url="addsupplier.php" data-title="Add Supplier"><i class="icon-plus-sign"></i> Add Supplier</button>
                </div>
                <div class="card-body">


<div style="margin-top: -19px; margin-bottom: 21px;">
<?php 
			include('../connect.php');
				$result = $db->prepare("SELECT * FROM supliers ORDER BY suplier_id DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			<div style="text-align:center;">
			Total Number of Suppliers: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
</div>
<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Search Supplier..." autocomplete="off" />
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover bg-white" id="resultTable">
	<thead>
		<tr>
			<th> Supplier </th>
			<th> Contact Person Name</th>
			<th> Address </th>
			<th> Phone Number</th>
			<th> Note</th>
			<th width="120"> Action </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM supliers ORDER BY suplier_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php echo $row['suplier_name']; ?></td>
			<td><?php echo $row['contact_person']; ?></td>
			<td><?php echo $row['suplier_address']; ?></td>
			<td><?php echo $row['suplier_contact']; ?></td>
			<td><?php echo $row['note']; ?></td>
			<td><button class="btn btn-warning btn-sm ajax-modal-btn" data-url="editsupplier.php?id=<?php echo $row['suplier_id']; ?>" data-title="Edit Supplier"><i class="icon-edit"></i> Edit</button>
			<a href="#" id="<?php echo $row['suplier_id']; ?>" class="delbutton btn btn-danger btn-sm text-white text-decoration-none" title="Click To Delete"><i class="icon-trash"></i> Delete</a></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>
                    </div><!-- table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap AJAX Modal -->
<div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="ajaxModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ajaxModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="ajaxModalBody">
        Loading...
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Handle AJAX modals
    $('.ajax-modal-btn').on('click', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        var title = $(this).data('title');
        $('#ajaxModalLabel').text(title);
        $('#ajaxModalBody').html('Loading...');
        var myModal = new bootstrap.Modal(document.getElementById('ajaxModal'));
        myModal.show();

        $.get(url, function(data) {
            $('#ajaxModalBody').html(data);
        }).fail(function() {
            $('#ajaxModalBody').html('<div class="alert alert-danger">Error loading content.</div>');
        });
    });

    $(".delbutton").click(function(e) {
        e.preventDefault();
        var element = $(this);
        var del_id = element.attr("id");
        var info = 'id=' + del_id;
        if(confirm("Are you sure want to delete? There is NO undo!")) {
            $.ajax({
                type: "GET",
                url: "deletesupplier.php",
                data: info,
                success: function(){
                    element.parents(".record").fadeOut("slow", function(){
                        $(this).remove();
                    });
                }
            });
        }
    });

    // Fix navbar toggle
    $(".btn-expand-collapse").click(function(e){
        e.preventDefault();
        var navbar = $(".navbar-primary");
        if(navbar.width() > 100){
            navbar.css("width", "60px");
            $(".navbar-primary-menu li a span").hide();
        } else {
            navbar.css("width", "250px");
            $(".navbar-primary-menu li a span").show();
        }
    });

	$("#filter").keyup(function() {
        var filter = $(this).val().toLowerCase();
        $("#resultTable tbody tr").each(function () {
            var rowText = $(this).text().toLowerCase();
            if (rowText.indexOf(filter) !== -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>
</body>
</html>