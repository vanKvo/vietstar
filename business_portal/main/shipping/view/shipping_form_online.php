<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';
require_once '../model/inventory_data.php';
require_once('../../../auth.php');
$position = $_SESSION['SESS_POSITION'];
$name = $_SESSION['SESS_NAME'];
// Populate the form with existing customer data 
$search_input_raw = isset($_GET['search_input']) ? $_GET['search_input'] : '';
$search_input = trim(htmlspecialchars($search_input_raw));
$customer = search_customer($search_input);
// Populate the form with new customer data or customer data submitted via Customer Portal
$shipping_order_id_raw = isset($_POST['shipping_order_id']) ? $_POST['shipping_order_id'] : '';
$shipping_order_id = trim(htmlspecialchars($shipping_order_id_raw));
$tmp = get_temp_shipping_order($shipping_order_id);
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
  <link rel="stylesheet" type="text/css" href="../../css/shipform.css">
  <link rel="stylesheet" type="text/css" href="../../css/forum_table.css">
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

    .required {
      color: red;
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
  <nav class="navbar-primary sticky">
    <a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
    <div class="navbar-primary-menu" id="myTopnav">
      <li><a class="d-flex align-items-center pl-3 text-white text-decoration-none">
          <h4>Shipping</h4>
        </a></li>
      <li><a href="../../index.php" class="nav-link text-white"><i class="icon-dashboard icon-2x"></i> Dashboard </a>
      </li>
      <li><a href="../index.php" class="nav-link text-white"> Search Customer</a></li>
      <li><a href="shipping_form_online.php" class="nav-link text-white active"> Shipping Form</a>
      </li>
      <li><a href="online_shipping_order.php" class="nav-link text-white"> Online Shipping Orders</a></li>
      <li><a href="paid_shipping_order.php" class="nav-link text-white"> Paid Shipping Orders</a></li>
    </div>
  </nav><!--/.navbar-primary-->
  <div class="main-content mt-10">
    <div class="content-header">
      Shipping Form
    </div>
    <form id="shipping-form" action="../logic/add_shipping_order.php" name='shipping_form'
      onSubmit="return formValidation();">
      <div class="container center">
        <div class="row">
          <input type="hidden" id="cust_id" name="cust_id" value="<?= $customer[0]['customer_id'] ?> ">
          <div class="subheader"> Sender</div>
          <div class="col-6">
            <div class="item">
              <label for="name"> Full Name<span class="required">*</span></label>
              <input id="name" type="text" name="cust_name"
                value="<?= ($customer[0] != 0) ? htmlspecialchars($customer[0]['cust_name']) : '' ?>" required />
            </div>
            <div class="item">
              <label for="phone">Phone (10 digits)<span class="required">*</span></label>
              <input id="cust_phone" type="tel" name="cust_phone"
                value="<?= ($customer[0] != 0) ? htmlspecialchars($customer[0]['cust_phone']) : '' ?>"
                placeholder="XXX-XXX-XXXX" required />
            </div>
            <div class="item">
              <label for="email">Email (optional)</label>
              <input id="email" type="text" name="cust_email"
                value="<?= ($customer[0] != 0) ? htmlspecialchars($customer[0]['cust_email']) : '' ?>">
            </div>
            <div class="item">
              <label for="address1">Address<span class="required">*</span></label>
              <input id="address1" type="text" name="cust_address"
                value="<?= ($customer[0] != 0) ? htmlspecialchars($customer[0]['cust_address']) : '' ?>" required>
            </div>
          </div><!--col-6-->
          <div class="col-6">
            <div class="item">
              <label for="city">City<span class="required">*</span></label>
              <input id="city" type="text" name="cust_city"
                value="<?= ($customer[0] != 0) ? htmlspecialchars($customer[0]['cust_city']) : '' ?>" required>
            </div>
            <div class="item">
              <label for="state">State<span class="required">*</span></label>
              <?php $currentState = ($customer[0] == 0) ? '' : $customer[0]['cust_state']; ?>
              <select name="cust_state" id="state" class="chzn-select" required data-placeholder="Select State...">
                <option value=""></option>
                <option value="VA" <?= $currentState == 'VA' ? 'selected' : '' ?>>Virginia</option>
                <option value="AL" <?= $currentState == 'AL' ? 'selected' : '' ?>>Alabama</option>
                <option value="AK" <?= $currentState == 'AK' ? 'selected' : '' ?>>Alaska</option>
                <option value="AZ" <?= $currentState == 'AZ' ? 'selected' : '' ?>>Arizona</option>
                <option value="AR" <?= $currentState == 'AR' ? 'selected' : '' ?>>Arkansas</option>
                <option value="CA" <?= $currentState == 'CA' ? 'selected' : '' ?>>California</option>
                <option value="CO" <?= $currentState == 'CO' ? 'selected' : '' ?>>Colorado</option>
                <option value="CT" <?= $currentState == 'CT' ? 'selected' : '' ?>>Connecticut</option>
                <option value="DE" <?= $currentState == 'DE' ? 'selected' : '' ?>>Delaware</option>
                <option value="DC" <?= $currentState == 'DC' ? 'selected' : '' ?>>District Of Columbia</option>
                <option value="FL" <?= $currentState == 'FL' ? 'selected' : '' ?>>Florida</option>
                <option value="GA" <?= $currentState == 'GA' ? 'selected' : '' ?>>Georgia</option>
                <option value="HI" <?= $currentState == 'HI' ? 'selected' : '' ?>>Hawaii</option>
                <option value="ID" <?= $currentState == 'ID' ? 'selected' : '' ?>>Idaho</option>
                <option value="IL" <?= $currentState == 'IL' ? 'selected' : '' ?>>Illinois</option>
                <option value="IN" <?= $currentState == 'IN' ? 'selected' : '' ?>>Indiana</option>
                <option value="IA" <?= $currentState == 'IA' ? 'selected' : '' ?>>Iowa</option>
                <option value="KS" <?= $currentState == 'KS' ? 'selected' : '' ?>>Kansas</option>
                <option value="KY" <?= $currentState == 'KY' ? 'selected' : '' ?>>Kentucky</option>
                <option value="LA" <?= $currentState == 'LA' ? 'selected' : '' ?>>Louisiana</option>
                <option value="ME" <?= $currentState == 'ME' ? 'selected' : '' ?>>Maine</option>
                <option value="MD" <?= $currentState == 'MD' ? 'selected' : '' ?>>Maryland</option>
                <option value="MA" <?= $currentState == 'MA' ? 'selected' : '' ?>>Massachusetts</option>
                <option value="MI" <?= $currentState == 'MI' ? 'selected' : '' ?>>Michigan</option>
                <option value="MN" <?= $currentState == 'MN' ? 'selected' : '' ?>>Minnesota</option>
                <option value="MS" <?= $currentState == 'MS' ? 'selected' : '' ?>>Mississippi</option>
                <option value="MO" <?= $currentState == 'MO' ? 'selected' : '' ?>>Missouri</option>
                <option value="MT" <?= $currentState == 'MT' ? 'selected' : '' ?>>Montana</option>
                <option value="NE" <?= $currentState == 'NE' ? 'selected' : '' ?>>Nebraska</option>
                <option value="NV" <?= $currentState == 'NV' ? 'selected' : '' ?>>Nevada</option>
                <option value="NH" <?= $currentState == 'NH' ? 'selected' : '' ?>>New Hampshire</option>
                <option value="NJ" <?= $currentState == 'NJ' ? 'selected' : '' ?>>New Jersey</option>
                <option value="NM" <?= $currentState == 'NM' ? 'selected' : '' ?>>New Mexico</option>
                <option value="NY" <?= $currentState == 'NY' ? 'selected' : '' ?>>New York</option>
                <option value="NC" <?= $currentState == 'NC' ? 'selected' : '' ?>>North Carolina</option>
                <option value="ND" <?= $currentState == 'ND' ? 'selected' : '' ?>>North Dakota</option>
                <option value="OH" <?= $currentState == 'OH' ? 'selected' : '' ?>>Ohio</option>
                <option value="OK" <?= $currentState == 'OK' ? 'selected' : '' ?>>Oklahoma</option>
                <option value="OR" <?= $currentState == 'OR' ? 'selected' : '' ?>>Oregon</option>
                <option value="PA" <?= $currentState == 'PA' ? 'selected' : '' ?>>Pennsylvania</option>
                <option value="RI" <?= $currentState == 'RI' ? 'selected' : '' ?>>Rhode Island</option>
                <option value="SC" <?= $currentState == 'SC' ? 'selected' : '' ?>>South Carolina</option>
                <option value="SD" <?= $currentState == 'SD' ? 'selected' : '' ?>>South Dakota</option>
                <option value="TN" <?= $currentState == 'TN' ? 'selected' : '' ?>>Tennessee</option>
                <option value="TX" <?= $currentState == 'TX' ? 'selected' : '' ?>>Texas</option>
                <option value="UT" <?= $currentState == 'UT' ? 'selected' : '' ?>>Utah</option>
                <option value="VT" <?= $currentState == 'VT' ? 'selected' : '' ?>>Vermont</option>
                <option value="WA" <?= $currentState == 'WA' ? 'selected' : '' ?>>Washington</option>
                <option value="WV" <?= $currentState == 'WV' ? 'selected' : '' ?>>West Virginia</option>
                <option value="WI" <?= $currentState == 'WI' ? 'selected' : '' ?>>Wisconsin</option>
                <option value="WY" <?= $currentState == 'WY' ? 'selected' : '' ?>>Wyoming</option>
              </select>
            </div>
            <div class="item">
              <label for="zip">Zip/Postal Code<span class="required">*</span></label>
              <input id="zip" type="text" name="cust_zip"
                value="<?= ($customer[0] != 0) ? htmlspecialchars($customer[0]['cust_zipcode']) : '' ?>" required>
            </div>
          </div><!--col-6-->
        </div>
        <?php if ($customer[0] == 0) { ?>
          <div class="row">
            <div class="subheader"> Recipient</div>
            <div class="item" id="recipient_form">
              <div class="item">
                <label for="name">New Recipient<span class="required">*</span></label>
                <input id="name" type="text" id="recipient_name" name="recipient_name"
                  value="<?= $tmp[0]['recipient_name'] ?>" required />
              </div>
              <div class="item">
                <label for="address">Address<span class="required">*</span></label>
                <input id="address" type="text" id="recipient_address" name="recipient_address"
                  value="<?= $tmp[0]['recipient_address'] ?>" required />
              </div>
              <div class="item">
                <label for="phone">Phone (10 digits only)<span class="required">*</span></label>
                <input id="recipient_phone" type="text" name="recipient_phone" placeholder="XXX-XXX-XXXX"
                  value="<?= $tmp[0]['recipient_phone'] ?>" required />
              </div>
              <div class="item">
                <label for="email">Email (optional)</label>
                <input id="recipient_email" type="text" name="recipient_email" />
              </div>
            </div><!--item-->
          </div><!--row-->
        <?php } else { ?>
          <div class="row">
            <div class="subheader"> Recipient</div>
            <div class="item">
              <label for="recipient">Select Recipient<span>*</span></label>
              <select name="recipient_id" id="recipient" class="chzn-select" data-placeholder="Choose a recipient...">
                <?php for ($i = 0; $i < count($customer) - 1; $i++) { ?>
                  <!--count($customer)-1: the number of recipients-->
                  <option value="<?= $customer[$i]['recipient_id'] ?>"><?= $customer[$i]['recipient_name'] ?> -
                    <?= $customer[$i]['recipient_phone'] ?> - <?= $customer[$i]['recipient_address'] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
            <button type="button" class="custom-btn add-recipient-btn col-2">Add New Recipient</button>
            <div class="item hidden" id="recipient_form">
              <div class="item">
                <label for="name">New Recipient</label>
                <input id="name" type="text" id="recipient_name" name="recipient_name" />
              </div>
              <div class="item">
                <label for="address">Address</label>
                <input id="address" type="text" id="recipient_address" name="recipient_address" />
              </div>
              <div class="item">
                <label for="phone">Phone (10 digits only)</label>
                <input id="recipient_phone" type="text" name="recipient_phone" placeholder="XXX-XXX-XXXX" />
              </div>
              <div class="item">
                <label for="email">Email (optional)</label>
                <input id="recipient_email" type="text" name="recipient_email" />
              </div>
              <input type="hidden" id="cust_id" name="cust_id" value="<?= $customer[0]['customer_id'] ?> ">
            </div><!--item-->
          </div><!--row-->
        <?php } ?>

        <div class="row">
          <div class="subheader item">
            <label>Package </label><br>
            <label>Total weight: </label>
            <input type="hidden" id="total_weight" name="total_weight">
            <output id="total_wt"></output>
          </div>
          <div class="item col-12">
            <div class="row">
              <div class="col-4">
                <label>No. of Packages<span class="required">*</span></label>
                <input type="number" id="num_pkg" name="num_pkg"
                  value="<?= isset($tmp[0]['num_of_package']) ? $tmp[0]['num_of_package'] : '' ?>" required />
                <label>Send To<span class="required">*</span></label>
                <input type="text" name="location" list="location"
                  value="<?= isset($tmp[0]['location']) ? $tmp[0]['location'] : '' ?>" required />
                <datalist id="location">
                  <option value="Sài Gòn" name="SG">Sài Gòn</option>
                  <option value="Tỉnh (Province)" name="province">Tỉnh</option>
                </datalist>
                <label>Price/lb ($)<span class="required">*</span></label>
                <input type="text" id="price_per_lb" name="price_per_lb" list="price_per_lb_list" placeholder="0.00"
                  required />
                <datalist id="price_per_lb_list">
                  <option value="3.25" name="SG">3.25</option>
                  <option value="3.5" name="SG">3.5</option>
                  <option value="3.75" name="province">3.75</option>
                </datalist>
              </div><!--col-4-->
              <div class="col-4">
                <label>Send Date<span class="required">*</span></label>
                <input type="date" name="send_dt" required />
                <label>Departure Date:</label>
                <input type="date" name="airport_dt">
              </div><!--col-4-->
              <div class="col-4">
                <div class="item">
                  <label>Total Package Value ($) (optional)</label>
                  <input type="text" name="pkg_val"
                    value="<?= isset($tmp[0]['package_value']) ? $tmp[0]['package_value'] : '' ?>" placeholder="0.00" />
                </div>
              </div><!--col-4-->
            </div><!--row-->
          </div><!--item-col-12-->
          <div class="item package_div">
            <?php
            if (!empty($tmp[0]['num_of_package'])) { // get packages from an online shipping form
              for ($i = 0; $i < $tmp[0]['num_of_package']; $i++) { ?>
                <div id="pkg<?= $i ?>" class="item">
                  <label style="font-weight: bold">Pkg #<?= ($i + 1) ?> Description of Goods</label>
                  <textarea class="form-control" name="pkg_desc<?= $i ?>" id="exampleFormControlTextarea1" rows="3"
                    required><?= $tmp[$i]['package_desc'] ?></textarea>
                  <label>Weight (lbs)</label>
                  <input id="pkg_wt<?= $i ?>" type="text" id="pkg_wt<?= $i ?>" name="pkg_wt<?= $i ?>" class="pkg_weight"
                    required />
                  <hr>
                </div><!--item-->
              <?php }
            } else { // get packages from a blank shipping form
              ?>
              <div id="pkg0" class="item"><!--no pkg id to avoid this pkg 1 is removed-->
                <label style="font-weight: bold">Pkg #1 Description of Goods</label>
                <textarea class="form-control" name="pkg_desc0" id="exampleFormControlTextarea1" rows="3"
                  required></textarea>
                <label>Weight (lbs)</label>
                <input id="pkg_wt0" type="text" id="pkg_wt0" name="pkg_wt0" class="pkg_weight" placeholder="0.00"
                  required />
                <hr>
              </div>
            <?php } ?>
          </div><!--item package_div-->
          <button type="button" id="add-package-btn" class="custom-btn col-1"><i class="fa fa-plus-circle"
              aria-hidden="true"></i> Add</button>
          <button type="button" id="remove-package-btn" class="custom-btn col-1"><i class="fa fa-minus-circle"
              aria-hidden="true"></i> Remove</button>
        </div><!--row-->
        <div class="row">
          <div class="subheader mt-3"> In-store items </div>
          <!--Start forum table-->
          <div id="forum-table">
            <div id="forum-table-header" class="pb-2">
              <div class="forum-table-header-cell">Item</div>
              <div class="forum-table-header-cell">Qty</div>
            </div><!--table-header-->
            <div id="forum-table-body">

            </div><!--table-body-->
          </div>
          <input type="hidden" id="num_of_items" name="num_of_items">
          <button type="button" id="add-item-btn" class="custom-btn col-1"><i class="fa fa-plus-circle"
              aria-hidden="true"></i></button>
          <button type="button" id="remove-item-btn" class="custom-btn col-1"><i class="fa fa-minus-circle"
              aria-hidden="true"></i></button>
          <button type="button" id="cal-item-btn" class="custom-btn col-1"><i class="fa fa-calculator"
              aria-hidden="true"></i></button>
          <!--End forum table-->
        </div><!--row-->
        <div class="row">
          <div class="subheader mt-3"> Items with Custom Fees </div>
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
                <div><input type="text" id="shipping_fee" name="shipping_fee" class="fee" placeholder="0.00"></div>
              </div><!--col-6-->
            </div><!--row-->
            <div class="row">
              <div class="item col-6">
                <label>Instore Item</label>
              </div><!--col-6-->
              <div class="item col-6">
                <div><input type="text" id="instore" name="instore" class="fee" placeholder="0.00"></div>
              </div><!--col-6-->
            </div><!--row-->
            <div class="row">
              <div class="col-6">
                <label>Custom Fee</label>
              </div><!--col-6-->
              <div class="item col-6">
                <div><input type="text" name="custom_fee" class="fee" placeholder="0.00" required></div>
              </div><!--col-6-->
            </div><!--row-->
            <div class="row">
              <div class="col-6">
                <label>Insurance</label>
              </div><!--col-6-->
              <div class="item col-6">
                <div><input type="text" name="insurance" class="fee" placeholder="0.00"></div>
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
            <div class="col-3">
              <label class="fw-bold">Payment Method<span class="required">*</span></label>
            </div><!--col-6-->
            <div class="col-9">
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
              $shipord = get_last_shipord();
              $mst = $shipord['mst'];
              ?>
              <label class="fs-4">MST (next MST: <?= $mst + 1 ?>)</label>
              <input type="hidden" id="next_mst" name="next_mst" value="<?= $mst + 1 ?>">
            </div><!--col-6-->
            <div class="col-6">
              <input type="text" id="mst" name="mst" value="<?= $mst + 1 ?>" required>
            </div><!--col-6-->
          </div><!--row-->
          <div>
          </div><!--col-12-->
        </div><!--row-->

        <button type="submit" class="custom-btn">Submit</button>

      </div><!--container center-->
    </form><!--shipping-form-->
  </div><!--main-content-->
</body>
<script type="text/javascript">
  function returnToPreviousPage() {
    window.history.back(); // not use, but good to use to return previous page
  }

  function formValidation() {

    var mst = document.getElementById('mst');
    var next_mst = document.getElementById('next_mst');
    var cust_phone = document.getElementById('cust_phone');
    var recipient_phone = document.getElementById('recipient_phone');

    var cust_phone_raw = cust_phone.value.replace(/-/g, '');
    var recipient_phone_raw = recipient_phone.value ? recipient_phone.value.replace(/-/g, '') : '';

    // checking phone number
    if (!cust_phone_raw.match(/^[0-9]{10}$/)) {
      alert("Phone number must be 10 characters long number");
      cust_phone.focus();
      return false;
    }

    if (recipient_phone_raw && !recipient_phone_raw.match(/^[0-9]{10}$/)) {
      alert("Phone number must be 10 characters long number");
      recipient_phone.focus();
      return false;
    }

    // Assign 10-digit unformatted values back before submit
    cust_phone.value = cust_phone_raw;
    if (recipient_phone) {
      recipient_phone.value = recipient_phone_raw;
    }

    // checking if valid mst 
    if ($('#mst').val() !== $('#next_mst').val()) {
      alert("Please enter a correct next MST: " + $('#next_mst').val());
      return false;
    }
    return true;
  }

  $(document).ready(function () {
    // Get the value of select option and search values in the select option
    /** Auto Format Phone fields */
    $('#cust_phone, #recipient_phone').on('input', function (e) {
      if (e.target.value.length > 0) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');
      }
    });

    /** Toggle dashboard */
    $(".toggle-navbar-btn").click(function () {
      $(".navbar-primary").toggle();
    });

    /** Toggle recipient form */
    $(".add-recipient-btn").click(function () {
      $("#recipient_form").toggle();
    });

    /** Add Package */
    var $num_pkg = $('#num_pkg').val();
    if ($num_pkg) { // a value exists (not empty or not null)
      var i = parseInt($num_pkg) - 1;
    } else {
      var i = 0;
    }
    $('#add-package-btn').on('click', function () {
      i = i + 1;// start with pkg1 i = 1, because pkg0 is displayed above already
      var field = '<div id="pkg' + i + '" class="item"><label style="font-weight: bold">Pkg #' + (i + 1) + ' Description of Goods</label><textarea class="form-control" name="pkg_desc' + i + '" rows="3" required></textarea><label>Weight (lbs)</label><input type="text" placeholder="0.00" class="pkg_weight" name="pkg_wt' + i + '" required/></div>';
      $('.package_div').append(field);
    })

    /** Remove Package */
    $('#remove-package-btn').on('click', function () {
      var id = 'pkg' + i;
      $('#' + id).remove();
      i = i - 1;
    })

    $(".chzn-select").chosen({ width: "100%" }).change(function () {
      // alert($(this).val());
    });
    // Automatically calculate inventory
    $(".forum-table-header-cell").on('input', '.instore-item', function () { // when user change a package weight
      alert('instore is clikced');
    });
    /**  Add Item */
    var item_idx = -1;
    $('#num_of_items').val(item_idx);
    $('#add-item-btn').on('click', function () {
      item_idx = item_idx + 1;
      var item = '<div id="item' + item_idx + '" class="forum-table-row">'
        + '<div class="forum-table-header-cell">'
        + ' <select id="item' + item_idx + '" name="item' + item_idx + '" class="chzn-select instore-item">'
        + ' <option></option>'
      <?php
      $products = get_products();
      for ($i = 0; $i < count($products); $i++) {
        ?>
          + '   <option value="<?php echo $products[$i]['product_id']; ?>" data-value=' + "'" + '{"product_id":"<?php echo $products[$i]['product_id']; ?>", "unit_price":"<?php echo $products[$i]['unit_price']; ?>"}' + "'" + '><?php echo $products[$i]['product_name']; ?> | Qty: <?php echo $products[$i]['qty_onhand']; ?> | Code: <?php echo $products[$i]['product_code']; ?>| Unit Price: <?php echo $products[$i]['unit_price']; ?></option>'
      <?php } ?>
        + ' </select>'
        + '</div>'
        + '<div class="forum-table-header-cell"><input class="instore-item" type="number" id="picked_qty' + item_idx + '" name="picked_qty' + item_idx + '"></div>'
        + ' </div>';
      $('#forum-table-body').append(item);
      $('#num_of_items').val(item_idx);
      $(".chzn-select").chosen().change(function () { // this function allows we can type text in select tag
        // alert($(this).val());
      });
    });

    /** Remove Item */
    $('#remove-item-btn').on('click', function () {
      var id = 'item' + item_idx;
      $('#' + id).remove();
      item_idx = item_idx - 1;
      $('#num_of_items').val(item_idx);
    });

    /** Automatically calculate total amount of picked instore items */
    $('#cal-item-btn').on('click', function () {
      //alert('cal Total Instore Amount | item_idx: '+ item_idx);
      var total_instore = 0;
      for (let k = item_idx; k > -1; k--) {
        var qty = parseInt($('#picked_qty' + k).val());
        var unit_price = parseFloat($('#item' + k).find(":selected").data("value").unit_price);
        total_instore = total_instore + qty * unit_price;
        console.log('Item_idx: ' + k + ' Total: ' + total_instore);
      }
      $('#instore').val(total_instore.toFixed(2));
    });

    // Automatically calculate total package weight
    $(".item").on('input', '.pkg_weight', function () {
      var sum = 0;
      $('.item .pkg_weight').each(function () {
        var inputVal = $(this).val();
        if ($.isNumeric(inputVal)) {
          sum += parseFloat(inputVal);
        }
      });
      $('#total_wt').text(' ' + sum + ' lb(s)');
      $('#total_weight').val(sum); // Pass total weight to the server
    });

    // Automatically calculate total payment
    $(".item").on('input', '.fee', function () {
      var sum = 0;
      $('.item .fee').each(function () {
        var inputVal = $(this).val();
        if ($.isNumeric(inputVal)) {
          sum += parseFloat(inputVal);
        }
      });
      $('#total_pmt').text(' $' + sum.toFixed(2));
      $('#amount').val(sum.toFixed(2));
    });

    // Automatically calculate Shipping Fee 
    $(".item").on('input', '.pkg_weight', function () { // when user change a package weight
      $('.item .pkg_weight').each(function () {
        var wt = parseFloat($('#total_wt').val());
        var price_per_lb = parseFloat($('#price_per_lb').val());
        $('#shipping_fee').val((wt * price_per_lb).toFixed(2));
      });
      $('#total_weight').val(sum); // Pass total weight to the server
    });

    // Update total shipping fee & total amount when user change price per lb
    $('#price_per_lb').change(function () {
      // update total shiping fee
      var wt = parseFloat($('#total_wt').val());
      var price_per_lb = parseFloat($('#price_per_lb').val());
      $('#shipping_fee').val((wt * price_per_lb).toFixed(2));
    });


  });

</script>

</html>