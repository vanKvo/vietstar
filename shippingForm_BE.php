<?php
    session_start();
    include('./connect.php');
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>
<?php
    // grabs sender input data
    $full_name = $_POST['full_name'];
    $num_of_package = $_POST['num_of_package'];
    $package_value = $_POST['package_value'];
    if (empty($_POST['package_value']))  $package_value = 0;
    else  $package_value = $_POST['package_value'];

    if (empty($_POST['address1'])) $address1 = 'NA';
    else $address1 = $_POST['address1'];

    if (empty($_POST['city'])) $city = 'NA';
    else $city = $_POST['city'];

    if (empty($_POST['zip_code'])) $zip_code = '00000';
    else $zip_code = $_POST['zip_code'];

    if (empty($_POST['state'])) $state = 'NA';
    else  $state = $_POST['state'];

    if (empty($_POST['email'])) $email = 'NA';
    else  $email = $_POST['email'];
   
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    // grabs recipient input data
    $full_name_r = $_POST['full_name_r'];
    $address_r1 = $_POST['address_r1'];
    $email_r = $_POST['email_r'];
    $phone_r = $_POST['phone_r'];
    $send_date = date("Y-m-d");

    // grabs item description input data
    $pkg1 = $_POST['pkg1'];
    //$pkg1_weight = $_POST['pkg1_weight'];
  
        
       $query = 'INSERT INTO `temp_shipping_order`(`num_of_package`, `package_value`, `location`, `cust_name`, `cust_address`, `cust_city`, `cust_state`, `cust_zip`, `cust_phone`, `cust_email`, `recipient_name`, `recipient_address`, `recipient_phone`, `recipient_email`, `submitted_date`, `package_desc`) 
                    VALUES (:v1, :v2, :v3, :v4, :v5, :v6, :v7,:v8, :v9, :v10, :v11, :v12, :v13, :v14, :v15, :v16)';
        $stmt = $db->prepare($query);
        $res = $stmt->execute(array(
          ':v1' =>$num_of_package,
          ':v2' =>$package_value,
          ':v3' =>$location, 
          ':v4' =>$full_name,
          ':v5' =>$address1,
          ':v6' =>$city,
          ':v7' =>$state,
          ':v8' =>$zip_code,
           ':v9' =>$phone,
           ':v10' =>$email,
           ':v11' =>$full_name_r,
           ':v12'=>$address_r1,
           ':v13' =>$phone_r,
           ':v14' =>$email_r,
           ':v15' =>$send_date,
           ':v16' =>$pkg1
           ));
        //header("location: shipping.php");

        if ($res) echo '<br>Success<br>';
        else echo '<br>Fail<br>';
?>
