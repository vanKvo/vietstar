<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';
require_once '../model/inventory_data.php';
require_once('../../../auth.php');
$position = $_SESSION['SESS_POSITION'] ?? '';
$name = $_SESSION['SESS_NAME'] ?? '';

$mst_raw = isset($_GET['mst']) ? $_GET['mst'] : '';
$mst = trim(htmlspecialchars($mst_raw));
$shipord = get_shipping_invoice_info($mst);

if (empty($shipord)) {
  echo "<div class='alert alert-danger'>Invoice not found (MST: " . htmlspecialchars($mst) . ").</div>";
  exit;
}

$sales_id = (isset($shipord[0]['sales_id'])) ? $shipord[0]['sales_id'] : '';
$sales_orders = [];
if (!empty($sales_id)) { // Some instore items are purcahse
  $sales_orders = get_sales_order($sales_id);
}
$total_instore = 0;
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
      background-color: #0d6efd;
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
        background: #505251;
      }

    }
  </style>
</head>

<body>
  <?php include 'navfixed.php'; ?>
  <?php
  $shipping_base_url = '..';
  $shipping_view_url = '.';
  $dashboard_url = '../../index.php';
  $active_tab = ''; // no specific tab highlighting needed for invoice
  include '../sidebar.php';
  ?>
  <div class="main-content mt-10">
    <div class="col-md-12">
      <div id="utility">
        <span class="pull-right hidden-print mb-3">
          <a href="javascript:Clickheretoprint()" class="btn btn-sm btn-white m-b-10 p-l-5"><i
              class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
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
            <small>Sender</small>
            <address class="m-t-5 m-b-5">
              <strong class="text-inverse"><?= htmlspecialchars($shipord[0]['cust_name'] ?? '') ?></strong><br>
              <?= htmlspecialchars($shipord[0]['cust_address'] ?? '') ?><br>
              <?= htmlspecialchars($shipord[0]['cust_city'] ?? '') ?>,
              <?= htmlspecialchars($shipord[0]['cust_state'] ?? '') ?>,
              <?= htmlspecialchars($shipord[0]['cust_zipcode'] ?? '') ?><br>
              Phone: <?= htmlspecialchars($shipord[0]['cust_phone'] ?? '') ?><br>
            </address>
          </div>
          <div class="invoice-to">
            <small>Recipient</small>
            <address class="m-t-5 m-b-5">
              <strong class="text-inverse"><?= htmlspecialchars($shipord[0]['recipient_name'] ?? '') ?></strong><br>
              <?= htmlspecialchars($shipord[0]['recipient_address'] ?? '') ?><br>
              Phone: <?= htmlspecialchars($shipord[0]['recipient_phone'] ?? '') ?><br>
            </address>
          </div>
          <div class="invoice-date">
            <div class="date text-inverse m-t-5">MST-<?= htmlspecialchars($shipord[0]['mst'] ?? '') ?></div>
            <small>
              Send date (y/m/d): <?= htmlspecialchars($shipord[0]['send_date'] ?? '') ?><br>
              Total Weight: <?= htmlspecialchars($shipord[0]['total_weight'] ?? '') ?> lb(s)<br>
              Total packages: <?= htmlspecialchars($shipord[0]['num_of_packages'] ?? '') ?><br>
              Value: $<?= htmlspecialchars($shipord[0]['package_value'] ?? '') ?><br>
              Send To: <?= htmlspecialchars($shipord[0]['location'] ?? '') ?><br>
              Price/lb: $<?= htmlspecialchars($shipord[0]['price_per_lb'] ?? '') ?><br>
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
              <?php for ($i = 0; $i < $shipord[0]['num_of_packages']; $i++) { ?>
                <tr>
                  <td width="25%"><?= ($i + 1) ?></td>
                  <td width="50%"><?= htmlspecialchars($shipord[$i]['package_desc'] ?? '') ?></td>
                  <td width="25%"><?= htmlspecialchars($shipord[$i]['package_weight'] ?? '') ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- end pkg-table-responsive -->
        <!-- begin in-store-item-table-responsive -->
        <?php if (!empty($sales_id)) { ?>
          <div class="graybox pt-2 pb-2">
            <strong class="text-inverse"><u> In-store items</u></strong><br>
          </div>
          <div class="table-responsive">
            <table class="table table-invoice">
              <thead>
                <tr>
                  <th width="25%">Item</th>
                  <th width="25%">Qty</th>
                  <th width="25%">Unit Price</th>
                  <th width="25%">Total Price</th>
                  <!--<th class="text-right" width="20%">Total weight</th>-->
                </tr>
              </thead>
              <tbody>
                <?php
                for ($j = 0; $j < count($sales_orders); $j++) {
                  $total_price = $sales_orders[$j]['qty_picked'] * $sales_orders[$j]['unit_price'];
                  $total_instore = $total_instore + $total_price;
                  ?>
                  <tr>
                    <td width="25%"><?= htmlspecialchars($sales_orders[$j]['product_name'] ?? '') ?></td>
                    <td width="25%"><?= htmlspecialchars($sales_orders[$j]['qty_picked'] ?? '') ?></td>
                    <td width="25%"><?= htmlspecialchars($sales_orders[$j]['unit_price'] ?? '') ?></td>
                    <td width="25%"><?= htmlspecialchars($total_price) ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div><!--table-responsive -->
        <?php } ?><!--is shown if some instore items are purchased -->
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
                $total_shipping_fee = round($shipord[0]['price_per_lb'] * $shipord[0]['total_weight'], 2);
                echo $total_shipping_fee;
                ?>
              </div><!--col-6-->
            </div><!--row-->
            <div class="row">
              <div class="col-6">
                <label>Custom Fee</label>
              </div><!--col-6-->
              <div class="item col-6">
                <?= htmlspecialchars($shipord[0]['custom_fee'] ?? '0.00'); ?>
              </div><!--col-6-->
            </div><!--row-->
            <div class="row">
              <div class="item col-6">
                <label>Instore Item</label>
              </div><!--col-6-->
              <div class="item col-6">
                <?= htmlspecialchars($total_instore); ?>
              </div><!--col-6-->
            </div><!--row-->
            <div class="row">
              <div class="col-6">
                <label>Insurance</label>
              </div><!--col-6-->
              <div class="item col-6">
                <?= htmlspecialchars($shipord[0]['insurance'] ?? '0.00'); ?>
              </div><!--col-6-->
            </div><!--row-->
            <hr>
            <div class="row">
              <div class="item col-6">
                <label class="fw-bold invoice-price-left">Total Amount</label>
              </div><!--col-6-->
              <div class="item col-6">
                <strong><?= htmlspecialchars($shipord[0]['amount'] ?? '0.00') ?> </strong>
              </div><!--col-6-->
            </div><!--row-->
            <div class="row mt-3">
              <div class="col-6">
                <label class="fw-bold">Payment Method</label>
              </div><!--col-6-->
              <div class="col-6">
                <strong><?= htmlspecialchars($shipord[0]['payment_method'] ?? '') ?> </strong>
              </div><!--col-6-->
            </div><!--row-->
          </div><!--col-12-->
        </div><!--row-->
        <!-- end payment-table-responsive -->
        <!--End Test code-->
      </div><!--print_content-->
    </div><!--col-md-12-->
  </div><!--main-content-->
</body>

<script>
  /** Toggle dashboard */
  $(".toggle-navbar-btn").click(function () {
    $(".navbar-primary").toggle();
  });

  function Clickheretoprint() {
    var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
    disp_setting += "scrollbars=yes,width=800, height=400, left=100, top=25";
    var content_vlue = document.getElementById("print_content").innerHTML;

    var docprint = window.open("", "", disp_setting);
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