<?php
    include('../connect.php');
    require_once('../../auth.php');
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    ?>
        <?php
            $recipient_id = $_GET['recipient_id'];
            $customer_id = $_GET['customer_id'];
            $query = "select * from recipient where recipient_id=:id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $recipient_id);
            $res = $stmt->execute();
            $recipient = $stmt->fetch();
            $recipient_id = $recipient['recipient_id'];
            $recipient_name = $recipient['recipient_name'];
            $recipient_address = $recipient['recipient_address'];
            $recipient_email = $recipient['recipient_email'];
            $recipient_phone = $recipient['recipient_phone'];

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
                                <h3 class="bg-success text-white text-center py-3"> Recipient Edit Section</h3>
                            </div>
                            <div class="card-body">

                                <form action="reupdate.php?recipient_id=<?php echo $recipient_id ?>&customer_id=<?php echo $customer_id?>" method="post">
                                    <input type="text" class="form-control mb-2" placeholder=" User name " name="name" value="<?php echo $recipient_name ?>">
                                    <input type="text" class="form-control mb-2" placeholder=" User address " name="address" value="<?php echo $recipient_address ?>">
                                    <input type="email" class="form-control mb-2" placeholder=" User email " name="email" value="<?php echo $recipient_email ?>">
                                    <input type="text" class="form-control mb-2" placeholder=" phone " name="phone" value="<?php echo $recipient_phone ?>">
                                    <button class="btn btn-primary" name="update">Update</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
</body>
</html>