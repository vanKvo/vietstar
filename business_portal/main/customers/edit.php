<?php
include('../connect.php');
require_once('../../auth.php');
$position = $_SESSION['SESS_POSITION'] ?? '';
$name = $_SESSION['SESS_NAME'] ?? '';

$id = $_GET['GetID'] ?? '';
$query = "select * from customer where customer_id=:id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id);
$res = $stmt->execute();
$customer = $stmt->fetch();

if (!$customer) {
    echo "Customer not found.";
    exit;
}

$customer_id = $customer['customer_id'];
$cust_name = $customer['cust_name'];
$cust_address = $customer['cust_address'];
$cust_city = $customer['cust_city'];
$cust_state = $customer['cust_state'];
$cust_zipcode = $customer['cust_zipcode'];
$cust_email = $customer['cust_email'];
$cust_phone = $customer['cust_phone'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/lib/bootstrap.css">
    <link rel="stylesheet" href="../css/lib/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/maindashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <style>
        .sticky { position: fixed; top: 53px; }
        .top-sticky { position: fixed; top: 0; width: 100%; }
        .required { color: red; }
    </style>
</head>

<body>
    <?php include 'navfixed.php'; ?>
    <nav class="navbar-primary sticky">
        <a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
        <ul class="navbar-primary-menu">
            <li> <a class="d-flex align-items-center pl-3 text-white text-decoration-none"><span class="fs-4">Customers</span></a></li>
            <li><a href="../index.php" class="nav-link text-white"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li>
            <li><a href="customer.php" class="nav-link text-white">Customer List</a></li>
        </ul>
    </nav>
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card mt-5">
                        <div class="card-header bg-primary text-white text-center">
                            <h3>Edit Customer Information</h3>
                        </div>
                        <div class="card-body">
                            <form action="update.php?ID=<?php echo $customer_id ?>" method="post">
                                <div class="mb-3">
                                    <label class="form-label">Full Name <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($cust_name) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($cust_address) ?>" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">City <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="city" value="<?php echo htmlspecialchars($cust_city) ?>" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">State <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="state" value="<?php echo htmlspecialchars($cust_state) ?>" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Zipcode <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="zipcode" value="<?php echo htmlspecialchars($cust_zipcode) ?>" pattern="[0-9]{5}" title="Please enter a 5-digit zipcode" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($cust_email) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone <span class="required">*</span></label>
                                    <input type="tel" id="phone" class="form-control" name="phone" value="<?php echo htmlspecialchars($cust_phone) ?>" placeholder="XXX-XXX-XXXX" required>
                                    <small class="text-muted">Format: 10 digits</small>
                                </div>
                                <button class="btn btn-primary w-100" name="update">Update Customer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#phone').on('input', function(e) {
                var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                e.target.value = !x[2] ? x[1] : x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');
            });

            $('form').on('submit', function() {
                // Remove dashes before submitting to database
                var phoneVal = $('#phone').val().replace(/-/g, '');
                if (phoneVal.length !== 10) {
                    alert('Phone number must be exactly 10 digits.');
                    return false;
                }
                $('#phone').val(phoneVal);
                return true;
            });
        });
    </script>
</body>

</html>