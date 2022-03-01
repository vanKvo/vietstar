<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';
require_once '../model/inventory_data.php';
require_once('../../../auth.php');
$position=$_SESSION['SESS_POSITION'];
$shipping_order_id = trim(filter_input(INPUT_POST, 'shipping_order_id', FILTER_SANITIZE_STRING));
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
  <link rel="stylesheet" type="text/css" href="../../css/navbar_new.css">
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
  <form id="shipping-form" action="../logic/add_shipping_order.php" autocomplete="on" name='registration' onSubmit="return formValidation();">  
    <div class="container center">
      <div class="row">
        <input type="hidden" id="cust_id" name="cust_id" value="<?=$customer[0]['customer_id']?> ">
        <div class="subheader"> Người Gửi (Sender)</div>
        <div class="col-6">
          <div class="item">
            <label for="name"> Họ & Tên (Full Name)<span>*</span></label>
            <input id="name" type="text" name="cust_name" value="<?=$tmp[0]['cust_name']?>" required/>
          </div>
          <div class="item">
              <label for="phone">SĐT (Phone)<span>*</span></label>
              <input id="phone" type="tel"  name="cust_phone" value="<?=$tmp[0]['cust_phone']?>" required/>
            </div>
            <div class="item">
              <label for="email">Email</label>
              <input id="email" type="text"   name="cust_email" value="<?=$tmp[0]['cust_email']?>">
            </div>
          <div class="item">
            <label for="address1">Địa Chỉ (Address)<span>*</span></label>
            <input id="address1" type="text"   name="cust_address" value="<?=$tmp[0]['cust_address']?>" required>
          </div>
        </div><!--col-6-->
          <div class="col-6">   
          <div class="item">
              <label for="city">City<span>*</span></label>
              <input id="city" type="text"   name="cust_city" value="<?=$tmp[0]['cust_city']?>" required>
            </div>
            <div class="item">
              <label for="state">State<span>*</span></label>
              <input  type="text"   name="cust_state" list="state" value="<?=$tmp[0]['cust_state']?>" required>
              <datalist id="state">
                  <option  value="VA">Virginia</option>
                  <option  value="AL">Alabama</option>
									<option  value="AK">Alaska</option>
									<option  value="AZ">Arizona</option>
									<option  value="AR">Arkansas</option>
									<option  value="CA">California</option>
									<option  value="CO">Colorado</option>
									<option  value="CT">Connecticut</option>
									<option  value="DE">Delaware</option>
									<option  value="DC">District Of Columbia</option>
									<option  value="FL">Florida</option>
									<option  value="GA">Georgia</option>
									<option  value="HI">Hawaii</option>
									<option  value="ID">Idaho</option>
									<option  value="IL">Illinois</option>
									<option  value="IN">Indiana</option>
									<option  value="IA">Iowa</option>
									<option  value="KS">Kansas</option>
									<option  value="KY">Kentucky</option>
									<option  value="LA">Louisiana</option>
									<option  value="ME">Maine</option>
									<option  value="MD">Maryland</option>
									<option  value="MA">Massachusetts</option>
									<option  value="MI">Michigan</option>
									<option  value="MN">Minnesota</option>
									<option  value="MS">Mississippi</option>
									<option  value="MO">Missouri</option>
									<option  value="MT">Montana</option>
									<option  value="NE">Nebraska</option>
									<option  value="NV">Nevada</option>
									<option  value="NH">New Hampshire</option>
									<option  value="NJ">New Jersey</option>
									<option  value="NM">New Mexico</option>
									<option  value="NY">New York</option>
									<option  value="NC">North Carolina</option>
									<option  value="ND">North Dakota</option>
									<option  value="OH">Ohio</option>
									<option  value="OK">Oklahoma</option>
									<option  value="OR">Oregon</option>
									<option  value="PA">Pennsylvania</option>
									<option  value="RI">Rhode Island</option>
									<option  value="SC">South Carolina</option>
									<option  value="SD">South Dakota</option>
									<option  value="TN">Tennessee</option>
									<option  value="TX">Texas</option>
									<option  value="UT">Utah</option>
									<option  value="VT">Vermont</option>
									<option  value="WA">Washington</option>
									<option  value="WV">West Virginia</option>
									<option  value="WI">Wisconsin</option>
									<option  value="WY">Wyoming</option>
              </datalist>  
            </div>
            <div class="item">
              <label for="zip">Zip/Postal Code<span>*</span></label>
              <input id="zip" type="text" name="cust_zip" value="<?=$tmp[0]['cust_zip']?>" required>
            </div>
        </div><!--col-6-->  
      </div>
    
      <div class="row">
        <div class="subheader"> Người Nhận (Recipient)</div>
        <div class="item" id="recipient_form">
         <!-- <form action="./index.php" method="post">-->
            <div class="item">
              <label for="name">(Người Nhận Mới) New Recipient</label>
              <input id="name" type="text" id="recipient_name" name="recipient_name" value="<?=$tmp[0]['recipient_name']?>"/>
            </div>
            <div class="item">
              <label for="address">Địa Chỉ (Address)</label>
              <input id="address" type="text"  id="recipient_address"  name="recipient_address" value="<?=$tmp[0]['recipient_address']?>"/>
            </div>
            <div class="item">
              <label for="phone">SĐT (Phone)</label>
              <input id="recipient_phone" type="text" id="recipient_phone"  name="recipient_phone" value="<?=$tmp[0]['recipient_phone']?>"/>
            </div>
    
            <!--<input type="hidden" id="cust_id" name="cust_id" value="<?=$customer[0]['customer_id']?> ">-->
          <!--</form>form-add-recipient-->
          </div><!--item-->
      </div><!--row-->  
      <div class="row">
         <div class="subheader item"> 
           <label>Package - Total weight: </label>
           <input type="hidden" id="total_weight" name="total_weight">
            <output id="total_wt"></output>
          </div>
          <div class="item col-12">
          <div class="row">
              <div class="col-4">
                <label>Number of packages</label>
                <input type="number"  id="num_pkg" name="num_pkg" value="<?=$tmp[0]['num_of_package']?>" required/>
                <label>Gửi Về (Location)</label>
                <input type="text"  name="location" list="location" value="<?=$tmp[0]['location']?>" required/>
                <datalist id="location">
                  <option value="Sài Gòn" name="SG">Sài Gòn</option>
                  <option value="Tỉnh (Province)" name="province">Tỉnh</option>
                </datalist>
                <label>Price/lb ($)</label>
                <input type="text" id="price_per_lb"  name="price_per_lb" list="price_per_lb_list" placeholder="0.00" required/>
                <datalist id="price_per_lb_list">
                  <option value="3.25" name="SG">3.5</option>
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
                  <input type="text" name="pkg_val"value="<?=$tmp[0]['package_value']?>" placeholder="0.00"/>
                </div> 
              </div><!--col-4-->      
            </div><!--row-->                  
          </div><!--item-col-12-->        
          <div class="item package_div">
            <?php 
              if (!empty($tmp[0]['num_of_package'])) { // get packages from an online shipping form
                for($i = 0; $i < $tmp[0]['num_of_package']; $i++) {?>
                  <div id="pkg<?=$i?>" class="item">
                    <label style="font-weight: bold">Pkg #<?=($i+1)?> Description</label>
                    <textarea class="form-control" name="pkg_desc<?=$i?>" id="exampleFormControlTextarea1" rows="3" required><?=$tmp[$i]['package_desc']?></textarea>
                    <label>Weight (lbs)</label>
                    <input id="pkg_wt<?=$i?>" type="text" id="pkg_wt<?=$i?>" name="pkg_wt<?=$i?>" class="pkg_weight" required/>
                    <hr>
                  </div><!--item-->  
            <?php } 
              } else { // get packages from a blank shipping form
            ?>
                <div id="pkg0" class="item"><!--no pkg id to avoid this pkg 1 is removed-->
                  <label style="font-weight: bold">Pkg #1 Description</label>
                  <textarea class="form-control" name="pkg_desc0" id="exampleFormControlTextarea1" rows="3" required></textarea>
                  <label>Weight (lbs)</label>
                  <input id="pkg_wt0" type="text" id="pkg_wt0" name="pkg_wt0" class="pkg_weight" placeholder="0.00" required/>
                  <hr>
                </div>  
            <?php } ?>    
          </div><!--item package_div-->
          <button type="button" id="add-package-btn" class="custom-btn col-1"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
          <button type="button" id="remove-package-btn" class="custom-btn col-1"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
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
          <button type="button" id="add-item-btn" class="custom-btn col-1"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
          <button type="button" id="remove-item-btn" class="custom-btn col-1"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
          <!--End forum table-->
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
              <div><input type="text"  id="shipping_fee" name="shipping_fee" class="fee" placeholder="0.00"></div>
            </div><!--col-6-->
          </div><!--row--> 
          <div class="row">
            <div class="col-6">
              <label>Custom Fee</label>
            </div><!--col-6-->
            <div class="item col-6">
              <div><input type="text"  name="custom_fee" class="fee" placeholder="0.00" required></div>  
            </div><!--col-6-->
          </div><!--row-->
          <div class="row">
            <div class="item col-6">
              <label>In-store Item</label>
            </div><!--col-6-->
            <div class="item col-6">
              <div><input type="text" id="instore"  name="instore" class="fee" placeholder="0.00"></div>
            </div><!--col-6-->
          </div><!--row--> 
          <div class="row">
            <div class="col-6">
              <label>Insurance</label>
            </div><!--col-6-->
            <div class="item col-6">
              <div><input type="text"  name="insurance" class="fee" placeholder="0.00"></div>
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
              <input type="hidden" id="next_mst" name="next_mst" value="<?=$mst+1?>"> 
            </div><!--col-6-->
            <div class="col-6">
              <input type="text" id="mst" name="mst" required> 
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
function returnToPreviousPage() {
    window.history.back(); // not use, but good to use to return previous page
}

function formValidation() {
  var mst = document.getElementById('mst');
  var next_mst = document.getElementById('next_mst');
  if ($('#mst').val()  !== $('#next_mst').val()) {
    alert("Xin vui lòng điền đúng số MST tiếp theo - Please enter a correct next MST: " + $('#next_mst').val());
    return false;
  }
  return true;
}

function containsObject(obj, list) {
    var i;
    for (i = 0; i < list.length; i++) {
        if (list[i] === obj) {
            return true;
        }
    }
    return false;
}

$(document).ready(function(){
  // Get the value of select option and search values in the select option

  /** Toggle recipient form */
  $(".add-recipient-btn").click(function(){
    $("#recipient_form").toggle();
  });
  
  /** Add Package */
  var $num_pkg = $('#num_pkg').val();
  if ($num_pkg) { // a value exists (not empty or not null)
    var i = parseInt($num_pkg);
  } else {
    var i = 0; 
  }
  $('#add-package-btn').on('click', function() {
    i = i+1;// start with pkg1 i = 1, because pkg0 is displayed above already
    var field = '<div id="pkg'+i+'" class="item"><label style="font-weight: bold">Pkg #'+(i+1)+' Description</label><textarea class="form-control" name="pkg_desc'+i+'" rows="3"></textarea><label>Weight (lbs)</label><input type="text" placeholder="0.00" class="pkg_weight" name="pkg_wt'+i+'"/></div>';
    $('.package_div').append(field);
  })

  /** Remove Package */
  $('#remove-package-btn').on('click', function() {
    var id = 'pkg'+i;
    $('#'+id).remove();
    i = i-1;
  })

  $(".chzn-select").chosen().change(function() {
    // alert($(this).val());
    });
      // Automatically calculate inventory
  $(".forum-table-header-cell").on('input', '.instore-item', function() { // when user change a package weight
        alert('instore is clikced');
  });
  /**  Add Item */
  var item_idx = -1;
  var total_instore = 0;
  //var products = []; // store product ids that are selected
  var products = new Map();
  var ids = [];
  var product_id = '';
  $('#num_of_items').val(item_idx);
  $('#add-item-btn').on('click', function() {  
    //console.log('Begin add-item-btn function()');
    item_idx = item_idx+1;
    var item = '<div id="item'+item_idx+'" class="forum-table-row">'    
                +'<div class="forum-table-header-cell">'
                + ' <select id="item'+item_idx+'" name="item'+item_idx+'" class="chzn-select instore-item">'
                +   ' <option></option>'
                    <?php
                       $products = get_products();
                      for($i=0; $i < count($products); $i++){
                    ?>
                + '   <option value="<?php echo $products[$i]['product_id'];?>" data-value='+"'"+'{"product_id":"<?php echo $products[$i]['product_id'];?>", "unit_price":"<?php echo $products[$i]['unit_price'];?>"}'+"'"+'><?php echo $products[$i]['product_name']; ?> | Qty: <?php echo $products[$i]['qty_onhand']; ?> | Code: <?php echo $products[$i]['product_code']; ?>| Unit Price: <?php echo $products[$i]['unit_price']; ?></option>' 
                    <?php } ?>
                + ' </select>'
                + '</div>'
                + '<div class="forum-table-header-cell"><input class="instore-item" type="number" id="picked_qty'+item_idx+'" name="picked_qty'+item_idx+'"></div>'
              +' </div>';
    $('#forum-table-body').append(item);
    //$(item).appendTo('#forum-table-body');
    $('#num_of_items').val(item_idx);
    $(".chzn-select").chosen().change(function() { // this function allows we can type text in select tag
    // alert($(this).val());
    });
      // Automatically calculate instore items that are sold
    $(".forum-table-header-cell").on('input', '.instore-item', function() { // when user change a package weight
     // console.log('Begin forum-table-header-cell input instore-item func');
      product_id =  parseFloat($('#item'+item_idx).find(":selected").data("value").product_id);
      var qty = parseInt($('#picked_qty'+item_idx).val());
      var unit_price =  parseFloat($('#item'+item_idx).find(":selected").data("value").unit_price);
      var product = {"unit_price":unit_price, "qty":qty};
      
      if (ids.includes(product_id)) {  // product exists in the array
        //alert("# of products in map: " + products.size +"prod exists in the map: Prod_id - " + product_id + " Qty: " +  products.get(product_id).qty + " NEw qty: " + qty);
        // is product picked qty changed?
        if (products.get(product_id).qty != qty && !Number.isNaN(qty) && (qty > 0)) {
          let current_qty = parseInt(products.get(product_id).qty);
          let new_qty = parseInt(qty);

          // update new qty for the product
          product = {"unit_price":unit_price, "qty":qty};
          products.set(product_id, product);

          total_instore = total_instore - current_qty*unit_price; // subtract the amount of old qtyå
          total_instore = total_instore + new_qty*unit_price;
          console.log("Total Instore: " + total_instore);
        }
      } else {// the selected product does not exist in the array yet
        ids.push(product_id);
        //products.push(product); // add product to the arr
        products.set(product_id, product);
        //alert(qty + 'unit_price: ' + unit_price + ' Prod_id:' + product_id + 'Products: ' + products + 'Num of prods: '+ products.length);
        total_instore = total_instore + qty*unit_price;
      }
      $('#instore').val(total_instore);
      //console.log('End forum-table-header-cell input instore-item func');
    });
    //console.log('End add-item-btn function()');
  });

  /** Remove Item */
    $('#remove-item-btn').on('click', function() {  
    var id = 'item'+item_idx;
    $('#'+id).remove();
    item_idx = item_idx-1;
    $('#num_of_items').val(item_idx);
    let current_qty = parseInt(products.get(product_id).qty);
    let unit_price = parseFloat(products.get(product_id).unit_price);
    total_instore = total_instore - current_qty*unit_price;
    $('#instore').val(total_instore);
    products.delete(product_id);
    console.log("# of products in map: " + products.size);
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
      var wt = parseFloat($('#total_wt').val()); 
      var price_per_lb = parseFloat($('#price_per_lb').val()); 
      $('#shipping_fee').val((wt*price_per_lb).toFixed(2));
    });
    $('#total_weight').val(sum); // Pass total weight to the server
  });

// Update total shipping fee & total amount when user change price per lb
  $('#price_per_lb').change(function() { 
    // update total shiping fee
    var wt = parseFloat($('#total_wt').val()); 
    var price_per_lb = parseFloat($('#price_per_lb').val()); 
    $('#shipping_fee').val((wt*price_per_lb).toFixed(2));
  });


});
 
 </script> 
</html>