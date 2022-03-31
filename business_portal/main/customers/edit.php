    
    
    <?php
    include('../connect.php');
    require_once('../../auth.php');
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    ?>
        <?php
            $id = $_GET['GetID'];
            $query = "select * from customer where customer_id=:id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id);
            $res = $stmt->execute();
            /*if ($res) echo "Success";
            else echo "Fail";*/
            $customer = $stmt->fetch();
            $customer_id = $customer['customer_id'];
            $cust_name = $customer['cust_name'];
            $cust_address= $customer['cust_address'];
            $cust_city= $customer['cust_city'];
            $cust_state= $customer['cust_state'];
            $cust_zipcode= $customer['cust_zipcode'];
            $cust_email = $customer['cust_email'];
            $cust_phone = $customer['cust_phone'];

        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" a href="CSS/bootstrap.css"/>
    <title>Document</title>
</head>
<body class="bg-dark">
    <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="card mt-5">
                            <div class="card-title">
                                <h3 class="bg-success text-white text-center py-3"> Customer information edit</h3>
                            </div>
                            <div class="card-body">

                                <form action="update.php?ID=<?php echo $customer_id ?>" method="post">
                                    <input type="text" class="form-control mb-2" placeholder=" User Name " name="name" value="<?php echo $cust_name ?>">
                                    <input type="text" class="form-control mb-2" placeholder=" User address " name="address" value="<?php echo $cust_address ?>">
                                    <input type="text" class="form-control mb-2" placeholder=" User city " name="city" value="<?php echo $cust_city ?>">
                                    <input type="text" class="form-control mb-2" placeholder=" User state " name="state" value="<?php echo $cust_state ?>">
                                    <input type="text" class="form-control mb-2" placeholder=" User zipcode " name="zipcode" value="<?php echo $cust_zipcode ?>">
                                    <input type="email" class="form-control mb-2" placeholder=" User email " name="email" value="<?php echo $cust_email ?>">
                                    <input type="text" class="form-control mb-2" placeholder=" User phone " name="phone" value="<?php echo $cust_phone ?>">
                                    <button class="btn btn-primary" name="update">Update</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
</body>
</html>