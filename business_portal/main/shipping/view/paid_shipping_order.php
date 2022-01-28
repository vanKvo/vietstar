<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';
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
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
  <link rel="stylesheet" href="../../css/lib/bootstrap.css">
  <link rel="stylesheet" href="../../css/lib/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../../css/navbar.css">
  <script src="../../js/lib/jquery.min.js"></script>
	<script src="../../js/scripts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<title>Paid Shipping Orders</title>
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

  .hidden {
      display: none;
   }

   .modal-mask {
     position: fixed;
     z-index: 9998;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     background-color: rgba(0, 0, 0, .5);
     display: table;
     transition: opacity .3s ease;
   }

   .modal-wrapper {
     display: table-cell;
     vertical-align: middle;
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
	<nav class="navbar-primary">
		<a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
		<div class="navbar-primary-menu" id="myTopnav"> 
			<li> <a class="d-flex align-items-center pl-3 text-white text-decoration-none"><i class="icon-truck icon-2x icon-2x"></i><span class="fs-4">Gửi Hàng (Shipping)</span></a></li>        
			<li><a href="../index.php" class="nav-link text-white"> > Trang Chủ (Home)</a></li>
      <li><a href="shipping_form.php" class="nav-link text-white"> > Tạo Đơn Gửi Hàng (Shipping Form)</a></li>
      <li><a href="#" class="nav-link text-white"> > Đơn Gửi Hàng Online (Online Shipping Orders)</a></li>
      <li><a href="#" class="nav-link text-white active"> > Đơn Gửi Hàng Đã Thanh Toán (Paid Shipping Orders)</a></li>		
      <li><a href="#"><i class="icon-off icon-large"></i> Log Out</a></li>
    </div>
	</nav><!--/.navbar-primary-->
	<div class="main-content mt-0">
    <div class="container" id="searchApp">
			<br />
			<h3 align="center">Paid Shipping Orders</h3>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-9">
						</div>
						<div class="col-md-3" align="right">
							<input type="text" class="form-control input-sm" placeholder="Search Data" v-model="query" @keyup="fetchData()" />
						</div>
					</div>
				</div><!--panel-heading-->
				<div class="panel-body">
          <div class="table-responsive">
						<table class="table table-bordered table-striped">
							<tr>
								<th>MST</th>
                <th>Send Date</th>
								<th>Sender</th> 
                <th>Total weight (lbs.)</th>
                <th>No. packages</th>
                <th></th>
                <th></th>
							</tr>
							<tr v-for="row in allData">
								<td>{{ row.mst}}</td>
                <td>{{ row.send_date}}</td>
								<td>{{ row.cust_name}}</td>
                <td>{{ row.total_weight}}</td>
                <td>{{ row.num_of_packages}}</td>
                <td><button type="button" name="edit" class="btn btn-primary btn-xs edit" @click="fetchShippingOrd(row.shipping_order_id)">Edit</button></td>
               <!-- <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" @click="deleteData(row.id)">Delete</button></td>-->
							</tr>
							<tr v-if="nodata">
								<td colspan="2" align="center">No Data Found</td>
							</tr>
						</table>
					</div>
				</div><!--panel-body-->
			</div>
      <div v-if="myModel">
        <transition name="model">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" @click="myModel=false"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ dynamicTitle }}</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>MST</label>
                  <input type="text" class="form-control" v-model="mst" disabled/>
                </div>
                <div class="form-group">
                  <label>Sender</label>
                  <input type="text" class="form-control" v-model="cust_name" />
                </div>
                <div class="form-group">
                  <label>Recipient</label>
                  <input type="text" class="form-control" v-model="recipient_name" />
                </div>
                <div class="form-group">
                  <label>Send Date</label>
                  <input type="date" class="form-control" v-model="send_date" />
                </div>
                <div class="form-group">
                  <label>To Airport Date</label>
                  <input type="date" class="form-control" v-model="airport_date" />
                </div>
                <div class="form-group">
                  <label>Total weight</label>
                  <input type="text" class="form-control" v-model="total_wt" />
                </div>
                <div class="form-group">
                  <label>Total payment</label>
                  <input type="text" class="form-control" v-model="total_pmt" />
                </div>
                <br />
                <div align="center">
                <input type="hidden" v-model="hiddenId" />
                <input type="button" class="btn btn-success btn-xs" v-model="actionButton" @click="submitData" />
                </div>
              </div>
              </div>
            </div>
          </div><!--modal-wrapper-->
        </div><!--modal-mask-->
        </transition>
      </div><!--myModel-->
		</div><!--searchApp-->
  <!--</div>-->
	</div><!--main-content-->  
</body>
</html>

<script>
var application = new Vue({
	el:'#searchApp',
	data:{
		allData:'',
		query:'',
		nodata:false,
    myModel: false,
    actionButton:'Insert',
    dynamicTitle:'Add Data'
	},
	methods: {
		fetchData:function(){
			axios.post('../logic/get_paid_shipping_orders.php', {
				query:this.query
			}).then(function(response){
				if(response.data.length > 0)
				{
					application.allData = response.data;
          console.log(application.allData);
					application.nodata = false;
				}
				else
				{
					application.allData = '';
					application.nodata = true;
				}
			});
		},
    fetchShippingOrd:function(shipping_order_id){
      axios.post('../logic/action.php', {
        action:'fetchShippingOrd',
        id:shipping_order_id
      }).then(function(response){
        //application.allData = response.data;
        //console.log(application.allData);
        application.mst = response.data[0].mst;
        application.cust_name = response.data[0].cust_name;
        application.recipient_name = response.data[0].recipient_name;
        application.send_date = response.data[0].send_date;
        application.total_wt = response.data[0].total_weight;
        application.total_pmt = response.data[0].total_pmt;
        application.hiddenId = response.data[0].shipping_order_id;
        application.myModel = true;
        application.actionButton = 'Update';
        application.dynamicTitle = 'Edit Data';
      });
    },
    submitData:function(){
      if(application.mst = '')
      {
        if(application.actionButton == 'Insert')
        {
        axios.post('action.php', {
          action:'insert',
          firstName:application.first_name, 
          lastName:application.last_name
        }).then(function(response){
          application.myModel = false;
          application.fetchAllData();
          application.first_name = '';
          application.last_name = '';
          alert(response.data.message);
        });
        }
        if(application.actionButton == 'Update')
        {
        axios.post('../logic/action.php', {
          action:'update',
          firstName : application.first_name,
          lastName : application.last_name,
          hiddenId : application.hiddenId
        }).then(function(response){
          application.myModel = false;
          application.fetchAllData();
          application.first_name = '';
          application.last_name = '';
          application.hiddenId = '';
          alert(response.data.message);
        });
        }
      }
      else
      {
        alert("Fill All Field");
      }
    } 
	},
	created:function(){
		this.fetchData();
	}
});

</script>