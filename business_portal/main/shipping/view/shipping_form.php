<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';
require_once('../../../auth.php');
$position=$_SESSION['SESS_POSITION'];
$search_input = trim(filter_input(INPUT_GET, 'search_input', FILTER_SANITIZE_STRING));
$customer = search_customer($search_input);
//print_r($customer);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
  <link rel="stylesheet" href="../../css/lib/bootstrap.css">
  <link rel="stylesheet" href="../../css/lib/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../../css/navbar_new.css">
  <link rel="stylesheet" type="text/css" href="../../css/shipform.css">
  <script src="../../js/lib/jquery.min.js"></script>
	<script src="../../js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js" type="text/javascript"></script>
	<title>Shipping Form</title>
  <style>  
  .subheader {
    background-color: #EBECF0;
    text-align: left;
    padding: 5px 0px;
    padding-left: 8px;
    font-weight: bold;
    margin-bottom: 5px;
    margin-top: 5px;
  }
  .custom-btn {
    background-color: #0d6efd  ;
    border: none;
    color: white;
    padding: 5px 8px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 1px 1px;
    cursor: pointer;
    margin-left: 10px;
  }
 /* .hidden {
      display: none;
   }
  .horizontal-display {
    display: inline-block;
  }*/
.sticky {
  position: fixed;
  top: 53 px;
}

.top-sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

  @media only screen and (max-width: 991px) {
  .navbar-primary {
    background: blue;
  }
  
}
  </style>
</head>

<body>
<?php include '../../navfixed.php';?>
	<nav class="navbar-primary sticky">
		<a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
		<div class="navbar-primary-menu" id="myTopnav"> 
			<li> <a class="d-flex align-items-center pl-3 text-white text-decoration-none"><i class="icon-truck icon-2x icon-2x"></i><span class="fs-4">Gửi Hàng (Shipping)</span></a></li>        
			<li><a href="../index.php" class="nav-link text-white"> > Trang Chủ (Home)</a></li>
      <li><a href="shipping_form_online.php" class="nav-link text-white active"> > Tạo Đơn Gửi Hàng (Shipping Form)</a></li>
      <li><a href="online_shipping_order.php" class="nav-link text-white"> > Đơn Gửi Hàng Online (Online Shipping Orders)</a></li>
			<li><a href="paid_shipping_order.php" class="nav-link text-white"> > Đơn Gửi Hàng Đã Thanh Toán (Paid Shipping Orders)</a></li>		
      <li><a href="#"><i class="icon-off icon-large"></i> Log Out</a></li>
    </div>
	</nav><!--/.navbar-primary-->
	<div class="main-content mt-10">
  <div class="content-header">
            Đơn Gửi Hàng (Shipping Form)
  </div>  
  <form id="shipping-form" action="../logic/add_shipping_order.php" autocomplete="on">  
    <div class="container center">
      <div class="row">
        <div class="subheader"> Người Gửi (Sender)</div>
        <div class="col-6">
          <div class="item">
            <label for="name"> Họ & Tên (Full Name)<span>*</span></label>
            <input id="name" type="text" name="cust_name" value="<?=$customer[0]['cust_name']?>" required/>
          </div>
          <div class="item">
              <label for="phone">SĐT - Phone (10 digits)<span>*</span></label>
              <input id="phone" type="tel"  name="cust_phone" value="<?=$customer[0]['cust_phone']?>" placeholder="XXXXXXXXXX" required/>
            </div>
            <div class="item">
              <label for="email">Email</label>
              <input id="email" type="text"   name="cust_email" value="<?=$customer[0]['cust_email']?>">
            </div>
          <div class="item">
            <label for="address1">Địa Chỉ (Address)<span>*</span></label>
            <input id="address1" type="text"   name="cust_address" value="<?=$customer[0]['cust_address']?>">
          </div>
        </div><!--col-6-->
          <div class="col-6">   
          <div class="item">
              <label for="city">City<span>*</span></label>
              <input id="city" type="text"   name="cust_city" value="<?=$customer[0]['cust_city']?>">
            </div>
            <div class="item">
              <label for="state">State<span>*</span></label>
              <input id="state" type="text"   name="cust_state" value="<?=$customer[0]['cust_state']?>">
            </div>
            <div class="item">
              <label for="zip">Zip/Postal Code<span>*</span></label>
              <input id="zip" type="text" name="cust_zip" value="<?=$customer[0]['cust_zipcode']?>">
            </div>
        </div><!--col-6-->  
      </div>
    
      <div class="row">
        <div class="subheader"> Người Nhận - Recipient</div>
        <div class="item">
          <label for="recipient">Chọn Người Nhận - Select Recipient<span>*</span></label>
          <select name="recipient_id" id="recipient">
            <?php for ($i = 0; $i < count($customer)-1; $i++) { ?> <!--count($customer)-1: the number of recipients-->
              <option value="<?= $customer[$i]['recipient_id']?>"><?= $customer[$i]['recipient_name']?> - <?= $customer[$i]['recipient_phone']?> - <?=$customer[$i]['recipient_address']?></option>
            <?php } ?>
          </select>
        </div> 
        <button type="button" class="custom-btn add-recipient-btn col-2">Add New Recipient</button>
        <div class="item hidden" id="recipient_form">
          <!--<form action="./index.php" method="post">-->
            <div class="item">
              <label for="name">Người Nhận Mới - New Recipient</label>
              <input id="name" type="text" id="recipient_name" name="recipient_name"/>
            </div>
            <div class="item">
              <label for="address">Địa Chỉ - Address</label>
              <input id="address" type="text"  id="recipient_address"  name="recipient_address"/>
            </div>
            <div class="item">
              <label for="phone">SĐT - Phone (10 digits)</label>
              <input id="recipient_phone" type="text" id="recipient_phone"  name="recipient_phone" placeholder="XXXXXXXXXX"/>
            </div>
           <!-- <button type="button" class="btn btn-primary btn-sm" onclick="addRecipient()">Save Recipient</button> -->
            <input type="hidden" id="cust_id" name="cust_id" value="<?=$customer[0]['customer_id']?> ">
            <!--<input type="hidden" name="action" value="add_recipient">-->
         <!-- </form>form-add-recipient-->
          </div><!--item-->
      </div><!--row-->  
      <div class="row">
         <div class="subheader item"> 
           <label>Package - Total weight: </label>
           <input type="hidden" id="total_weight" name="total_weight" placeholder="0.00">
            <output id="total_wt"></output>
          </div>
          <div class="item col-12">
          <div class="row">
              <div class="col-4">
                <label>Number of packages</label>
                <input type="number"  id="num_pkg" name="num_pkg" required/>
                <label>Gửi Về (Location)</label>
                <input type="text"  name="location" list="location" required/>
                <datalist id="location">
                  <option value="Sài Gòn" name="SG">Sài Gòn</option>
                  <option value="Tỉnh (Province)" name="province">Tỉnh</option>
                </datalist>
                <label>Price/lb ($)</label>
                <input type="text" id="price_per_lb"  name="price_per_lb" list="price_per_lb_list" required/>
                <datalist id="price_per_lb_list">
                  <option value="3.5" name="SG">3.5</option>
                  <option value="3.75" name="province">3.75</option>
                </datalist>
              </div><!--col-4-->
              <div class="col-4">
                <label>Ngày Gửi (Send Date):</label>
                <input type="date" name="send_dt" required/>
                <label>Ngày Chuyển:</label>
                <input type="date" name="airport_dt">
              </div><!--col-4-->
              <div class="col-4">
                <div class="item">
                  <label>Trị Giá Hàng (Total value) ($)</label>
                  <input type="text" name="pkg_val"/>
                </div> 
              </div><!--col-4-->      
            </div><!--row-->                  
          </div><!--item-col-12-->        
          <div class="item package_div">
            <div class="item">
              <label style="font-weight: bold">Pkg #1 Description</label>
              <textarea class="form-control" name="pkg_desc1" id="exampleFormControlTextarea1" rows="3" required></textarea>
              <label>Weight (lbs)</label>
              <input id="pkg_wt1" type="text" id="pkg_wt1" name="pkg_wt1" class="pkg_weight" required/>
              <hr>
            </div><!--item-->  
          </div>
          <button type="button" class="custom-btn add-package-btn col-2">Add New Package</button>
      </div><!--row-->  
      <div class="row">
        <div class="subheader mt-3"> In-store items </div>
          <form action="incoming.php" method="post" >		
            <input type="hidden" name="pt" value="<?php echo $_GET['id']; ?>" />
            <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
            <select name="product" style="width:650px; "class="chzn-select" required>
            <option></option>
              <?php
                for($i=0; $i < count($products); $i++){
              ?>
                <option value="<?php echo $products[$i]['product_id'];?>"><?php echo $products[$i]['product_name']; ?>| Expires at: <?php echo $products[$i]['expiry_date']; ?></option>
              <?php
                    }
                  ?>
            </select>
            <input type="number" name="qty" value="1" min="1" placeholder="Qty" autocomplete="on" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" required>
            <input type="hidden" name="discount" value="" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" />
            <input type="hidden" name="date" value="<?php echo date("m/d/y"); ?>" />
            <button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;"><i class="icon-plus-sign icon-large"></i> Add</button>
          </form><!--select in-store item form-->
      </div><!--row-->  
      <div class="row">
        <div class="subheader mt-3"> Phụ Thu (Items with Custom Fees) </div>
          <div>
            <input type="text" name="custom_fee_taxed_item" placeholder="e.g, VITAMIN, BOX, SHOES">
          </div>    
      </div><!--row--> 
      <div class="row">
        <div class="subheader mt-3"> Payment ($) </div>
      </div><!--row-->  
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-6">
              <label>Shipping fee</label>
            </div><!--col-6-->
            <div class="item col-6">
              <div><input type="text"  id="shipping_fee" name="shipping_fee" class="fee"></div>
              <!--<output id="shipping_fee"class="fw-bold" style="float: left;"></output>-->
            </div><!--col-6-->
          </div><!--row--> 
          <div class="row">
            <div class="col-6">
              <label>Custom Fee</label>
            </div><!--col-6-->
            <div class="item col-6">
              <div><input type="text"  name="custom_fee" class="fee"></div>
              <!--<output id="shipping_fee"class="fw-bold" style="float: left;"></output>-->
            </div><!--col-6-->
          </div><!--row-->
          <div class="row">
            <div class="col-6">
              <label>Insurance</label>
            </div><!--col-6-->
            <div class="item col-6">
              <div><input type="text"  name="insurance" class="fee"></div>
              <!--<output id="shipping_fee"class="fw-bold" style="float: left;">200</output>-->
            </div><!--col-6-->
          </div><!--row-->
          <div class="row">
            <div class="item col-6">
              <label>In-store Item</label>
            </div><!--col-6-->
            <div class="item col-6">
              <div><input type="text"  name="instore" class="fee"></div>
            </div><!--col-6-->
          </div><!--row--> 
          <hr>
          <div class="row">
            <div class="item col-6">
              <label class="fw-bold">Total Amount</label>
            </div><!--col-6-->
            <div class="item col-6">
              <output id="total_pmt" class="fw-bold" style="float: left;"></output>
              <input type="hidden" id="amount" name="amount">
              </div>
            </div><!--col-6-->
          </div><!--row--> 
          <div class="row mt-3">
            <div class="col-6">
              <label class="fw-bold">Payment Method</label>
            </div><!--col-6-->
            <div class="col-6">
              <input type="radio" name="pmt" value="cash" required>
              <span> Cash |</span>        
              <input type="radio" name="pmt" value="credit" required>
              <span> Debit/Credit (3%) |</span>
              <input type="radio" name="pmt" value="zelle" required>
              <span> Zelle |</span>
              <input type="radio" name="pmt" value="venmo" required>
              <span> Venmo |</span>
              <input type="radio" name="pmt" value="check" required>
              <span> Check </span>
            </div><!--col-6-->
          </div><!--row--> 
          <div class="row mt-3">
            <div class="col-6">
              <?php 
                $shipord = get_last_shipord() ;
                $mst = $shipord['mst'];
              ?>
              <label class="fs-4">MST   (next MST: <?=$mst+1?>)</label>
            </div><!--col-6-->
            <div class="col-6">
              <input type="text" name="mst" required> 
            </div><!--col-6-->
          </div><!--row--> 
          <div >
        </div><!--col-12-->
      </div><!--row-->  

     <button type="submit" class="custom-btn">Submit</button>
 
    </div><!--container center-->   
  </form><!--shipping-form--> 
	</div><!--main-content-->  
</body>
<script type="text/javascript">
function addRecipient() {
  var recipient_phone = $('#recipient_phone').val();
  var recipient_name = $('#recipient_name').val();

  $.ajax({
    url: "test.php",
    type: "POST",
    data:{"myData":recipient_name}
  }).done(function(data) {
      console.log(data);
  });
 
}


$(document).ready(function(){
  $(".add-recipient-btn").click(function(){
    $("#recipient_form").toggle();
  });

  var i = 2;
  $('.add-package-btn').on('click', function() {
    //var field = '<div class="item"><label style="font-weight: bold">Pkg # '+i+' Description</label><textarea class="form-control" name="package_desc" id="exampleFormControlTextarea1" rows="3"></textarea><label>Weight (lbs)</label><input type="text"  name="weight" required/></div><label>Location</label><select name="location" id="location"><?php for ($i = 0; $i < count($locations); $i++) { ?><option value="<?=$locations[$i]['location']?>"> <?=$locations[$i]['location']?> - $<?=$locations[$i]['price_per_lb']?>/lb</option><?php } ?></select><hr>';
    var field = '<div class="item"><label style="font-weight: bold">Pkg #'+i+' Description</label><textarea class="form-control" name="pkg_desc'+i+'" rows="3"></textarea><label>Weight (lbs)</label><input type="text"  class="pkg_weight" name="pkg_wt'+i+'"/></div>';
    $('.package_div').append(field);
    i = i+1;
  })

    // Get the value of select option and search values in the select option
  $(".chzn-select").chosen().change(function() {
  alert($(this).val());
  });

// Automatically calculate total package weight
  $(".item").on('input','.pkg_weight',function() {
    var sum = 0; 
    $('.item .pkg_weight').each(function() {
      var inputVal = $(this).val();
      if ($.isNumeric(inputVal)) {
        sum += parseFloat(inputVal); 
      }
    });
    $('#total_wt').text(' ' + sum + ' lb(s)');
    $('#total_weight').val(sum); // Pass total weight to the server
  });

// Automatically calculate total payment
  $(".item").on('input','.fee',function() {
    var sum = 0; 
    $('.item .fee').each(function() {
      var inputVal = $(this).val();
      if ($.isNumeric(inputVal)) {
        sum += parseFloat(inputVal); 
      }
    });
    $('#total_pmt').text(' $' + sum.toFixed(2));
    $('#amount').val(sum.toFixed(2));
  });

// Automatically calculate Shipping Fee 
  $(".item").on('input','.pkg_weight',function() { // when user change a package weight
    $('.item .pkg_weight').each(function() {
      var wt = parseInt($('#total_wt').val()); 
      var price_per_lb = parseFloat($('#price_per_lb').val()); 
      $('#shipping_fee').val((wt*price_per_lb).toFixed(2));
    });
    $('#total_weight').val(sum); // Pass total weight to the server
  });

  $('#price_per_lb').change(function() { // when user change price per lb
    var wt = parseInt($('#total_wt').val()); 
    var price_per_lb = parseFloat($('#price_per_lb').val()); 
    $('#shipping_fee').val((wt*price_per_lb).toFixed(2));
  });

});
 
 </script> 
</html>