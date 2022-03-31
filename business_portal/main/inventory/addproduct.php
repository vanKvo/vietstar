<?php 
include('../connect.php');
require_once('auth.php');
?>
	
<form action="saveproduct.php" method="post" autocomplete="on" onSubmit="return formValidation();">
	<center><h4><i class="icon-plus-sign icon-large"></i> Add Product</h4></center>
	<hr>
	<div id="ac">
	<span>UPC: </span><input type="text" style="width:265px; height:30px;" id="product_code" name="product_code" required/><br>
	<span>Product Name: </span><input type="text" style="width:265px; height:30px;" id="product_name" name="product_name" required><br>
	<span>Category: </span><input type="text" style="width:265px; height:30px;" name="product_category" list="category" required><br>
	<datalist id="category">
		<option>Dairy</option>
		<option>Snack</option>
		<option>Food</option>
	</datalist>
	<span>Position: </span><input type="text" style="width:265px; height:30px;" name="product_location" ><br>
	<span>Selling Price : </span><input type="text" id="unit_price" style="width:265px; height:30px;" name="unit_price" onkeyup="sum();" required/><br>
	<span></span><input type="hidden" style="width:265px; height:30px;" id="txt22" name="qty_supplied" Required ><br>
	<div style="float:right; margin-right:10px;">
	<button class="btn btn-success btn-block btn-large" style="width:267px;">Submit</button>
	</div>
	</div>
</form>

<script>
function formValidation() {
	var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
	var unit_price = $('#unit_price').val();

	// checking if selling price is a number
  if (!numberRegex.test(unit_price)) {
    alert("Xin vui lòng nhập chữ số cho giá bán - Please enter a number for Selling Price");
    return false;
  } 
  return true;
}

$(document).ready(function(){
	$("#product_name").change(function(){
		var product_code = $('#product_code').val();
		$.ajax({
			type: 'GET',
			url: 'checkproductcode.php',
			dataType: 'json',
			data: {'product_code':product_code},
			success: function(response){
				if (response.num == 1) {
					alert('Universal Product Code (UPC) exists');
				}
			},
			error: function(){
				alert("Get ERROR when request checkproductcode.php");
			}
 		});
  });


});
</script>
<!--</body>

</html>-->