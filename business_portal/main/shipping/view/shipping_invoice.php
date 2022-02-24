<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';
$mst = trim(filter_input(INPUT_GET, 'mst', FILTER_SANITIZE_STRING));
$shipord = get_shipping_invoice_info($mst);
//print_r($shipord);
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
  <link rel="stylesheet" type="text/css" href="../../css/navbar.css">
  <link rel="stylesheet" type="text/css" href="../../css/shipping_invoice.css">
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
  <div class="col-md-12">
      <div id="utility">
        <span class="pull-right hidden-print mb-3">
          <a href="javascript:Clickheretoprint()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
        </span>
      </div>
      <div id="print_content" class="invoice">
        <div class="row">
          <div class="invoice-company text-inverse f-w-600 col-6">
              Vietstar Shipping Eden Center
          </div>   
            <div id="business-info" class="col-6">
              <p>
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-address-card"></i> Address: 6799 Wilson Blvd #26, 
                <br>Falls Church, VA 22044</span><br>
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone"></i> Tel: (703) 536-8888</span><br>
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>Website: vietstarshippingec.com</span><br>
              </p>
          </div>
        </div>
         <!-- begin invoice-header -->
         <div class="invoice-header">
            <div class="invoice-from">
               <small>Người Gửi - Sender</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse"><?=$shipord[0]['cust_name']?></strong><br>
                  <?=$shipord[0]['cust_address']?><br>
                  <?=$shipord[0]['cust_city']?>, <?=$shipord[0]['cust_state']?>, <?=$shipord[0]['cust_zipcode']?><br>
                  Phone: <?=$shipord[0]['cust_phone']?><br>
               </address>
            </div>
            <div class="invoice-to">
               <small>Người Nhận - Recipient</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse"><?=$shipord[0]['recipient_name']?></strong><br>
                  <?=$shipord[0]['recipient_address']?><br>
                  Phone: <?=$shipord[0]['recipient_phone']?><br>
               </address>
            </div>
            <div class="invoice-date">
              <div class="date text-inverse m-t-5">MST-<?=$shipord[0]['mst']?></div>
                <small> 
                  Ngày Gửi - Send date (y/m/d): <?=$shipord[0]['send_date']?><br>
                  Cân Nặng - Total Weight: <?=$shipord[0]['total_weight']?> lb(s)<br>
                  Số Lượng Thùng - Total packages: <?=$shipord[0]['num_of_packages']?><br>
                  Trị Giá Hàng - Value: $<?=$shipord[0]['package_value']?><br>
                  Gửi Đến - Send To: <?=$shipord[0]['location']?><br>
                  Price/lb: $<?=$shipord[0]['price_per_lb']?><br>
                </small>
              
            </div>
         </div>
         <!-- end invoice-header -->
         <!--Begin Test code-->
          <!-- begin pkg-table-responsive -->
          <div class="graybox pt-2 pb-2">
            <strong class="text-inverse"><u>Package</u></strong><br>
          </div>
          <div class="table-responsive">
              <table class="table table-invoice">
                <thead>
                    <tr>
                      <th width="25%">Pkg#</th>
                      <th width="50%">Description</th>
                      <th width="25%">Weight (lbs)</th>
                      <!--<th class="text-right" width="20%">Total weight</th>-->
                    </tr>
                </thead>
                <tbody>
                  <?php for($i = 0; $i < $shipord[0]['num_of_packages']; $i++) {?>
                    <tr>
                      <td width="25%"><?=($i+1)?></td>
                      <td width="50%"><?=$shipord[$i]['package_desc']?></td>
                      <td width="25%"><?=$shipord[$i]['package_weight']?></td>
                    </tr>
                  <?php } ?>            
                </tbody>
              </table>
          </div>
          <!-- end pkg-table-responsive -->
      <!-- begin in-store-item-table-responsive -->
          <div class="graybox pt-2 pb-2">
            <strong class="text-inverse"><u> In-store items</u></strong><br>
          </div>
          <div class="table-responsive">
            <table class="table table-invoice">
              <thead>
                  <tr>
                    <th  width="25%">Item</th>
                    <th  width="25%">Qty</th>
                    <th  width="25%">Unit Price</th>
                    <th width="25%">Total Price</th>
                    <!--<th class="text-right" width="20%">Total weight</th>-->
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td  width="25%">Ensure</td>
                    <td  width="25%">10</td>
                    <td  width="25%">13</td>
                    <td  width="25%">130</td>
                  </tr>
              </tbody>
            </table>
          </div><!--table-responsive -->
       
           <div class="row">
                <div class="col-7"></div>
                <div class="col-5"><strong>Total: </strong></div>
            </div>
      <!-- end in-store-item-table-responsive -->    
      <!-- begin payment-table-responsive -->   
      <div class="graybox pt-2 pb-2">
          <strong class="text-inverse"><u> Payment ($)</u></strong><br>
      </div>           
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-6">
              <label>Shipping fee</label>
            </div><!--col-6-->
            <div class="item col-6">
              <?php
                $total_shipping_fee =  round($shipord[0]['price_per_lb'] * $shipord[0]['total_weight'],2);
                echo $total_shipping_fee;    
              ?>
            </div><!--col-6-->
          </div><!--row--> 
          <div class="row">
            <div class="col-6">
              <label>Custom Fee</label>
            </div><!--col-6-->
            <div class="item col-6">
              <?=$shipord[0]['custom_fee'];?>
            </div><!--col-6-->
          </div><!--row-->
          <div class="row">
            <div class="col-6">
              <label>Insurance</label>
            </div><!--col-6-->
            <div class="item col-6">
              <?=$shipord[0]['insurance'];?>
            </div><!--col-6-->
          </div><!--row-->
          <div class="row">
            <div class="item col-6">
              <label>In-store Item</label>
            </div><!--col-6-->
            <div class="item col-6">
               Unkown
            </div><!--col-6-->
          </div><!--row--> 
          <hr>
          <div class="row">
            <div class="item col-6">
              <label class="fw-bold invoice-price-left">Total Amount</label>
            </div><!--col-6-->
            <div class="item col-6">
                    <strong><?=$shipord[0]['amount']?> </strong>
            </div><!--col-6-->
          </div><!--row--> 
          <div class="row mt-3">
            <div class="col-6">
              <label class="fw-bold">Payment Method</label>
            </div><!--col-6-->
            <div class="col-6">
              <strong><?=$shipord[0]['payment_method']?> </strong>
            </div><!--col-6-->
          </div><!--row--> 
        </div><!--col-12-->
      </div><!--row-->  
       <!-- end payment-table-responsive -->  
         <!--End Test code-->
            <!-- begin invoice-price -->
            <!--<div class="invoice-price">
               <div class="invoice-price-left">
                  <div class="invoice-price-row">
                     <div class="sub-price">
                        <small>SUBTOTAL</small>
                        <span class="text-inverse">$4,500.00</span>
                     </div>
                     <div class="sub-price">
                        <i class="fa fa-plus text-muted"></i>
                     </div>
                     <div class="sub-price">
                        <small>PAYPAL FEE (5.4%)</small>
                        <span class="text-inverse">$108.00</span>
                     </div>
                  </div>
                  TOTAL
               </div>
               <div class="invoice-price-right">
                  <span class="f-w-600">$4508.00</span>
               </div>
            </div>-->
            <!-- end invoice-price 
         </div>-->
         <!-- end invoice-content -->
         <!-- begin invoice-note -->
        <!-- <div class="invoice-note">
            * Make all cheques payable to [Your Company Name]<br>
            * Payment is due within 30 days<br>
            * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
         </div>-->
         <!-- end invoice-note -->
      </div><!--print_content-->
   </div><!--col-md-12-->
	</div><!--main-content-->  
</body>

<script>
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Vietstar Shipping</title><link rel="stylesheet" type="text/css" href="../../css/shipping_invoice.css"><link rel="stylesheet" href="../../css/lib/bootstrap.css">'); 
   docprint.document.write('</head><body onLoad="self.print()">');          
   docprint.document.write(content_vlue); 
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>

</html>