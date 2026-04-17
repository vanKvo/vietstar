<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';
require_once('../../../auth.php');
$position = $_SESSION['SESS_POSITION'] ?? '';
$name = $_SESSION['SESS_NAME'] ?? '';
$search_input_raw = isset($_GET['search_input']) ? $_GET['search_input'] : '';
$search_input = trim(htmlspecialchars($search_input_raw));
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
    .sticky {
      position: fixed;
      top: 53 px;
    }

    .top-sticky {
      position: fixed;
      top: 0;
      width: 100%;
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

    html {
      scroll-padding-top: 2px;
      /* your overlapping header/div height */
    }

    @media only screen and (max-width: 991px) {
      .navbar-primary {
        background: #505251;
      }

    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
  <?php include 'navfixed.php'; ?>
  <?php 
  $shipping_base_url = '..';
  $shipping_view_url = '.';
  $dashboard_url = '../../index.php';
  $active_tab = 'paid_shipping_order';
  include '../sidebar.php'; 
  ?>
  <div class="main-content mt-10">
    <div class="container" id="searchApp">
      <br />
      <h3 class="center">Paid Shipping Orders</h3>
      <br />
      <div class="center strong">
        From : <input type="date" v-model="date1" class="tcal" /> To: <input type="date" v-model="date2" class="tcal" />
        <button class="btn btn-info" type="submit" @click="fetchData(date1, date2)"><i class="icon icon-search icon-large"></i> Search</button>
        <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-download"></i> Export
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:exportTableToExcel('tblData', 'Paid_Shipping_Orders')"><i class="fa fa-file-excel-o"></i> Excel</a></li>
                <li><a class="dropdown-item" href="javascript:exportToPDF('tblData', 'Paid Shipping Orders')"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
            </ul>
        </div>
      </div>
      <div class="panel panel-default mb-3">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-9">
            </div>
            <div class="col-md-3" class="right mb-3">
              <input type="text" class="form-control input-sm" placeholder="Search Data" v-model="query"
                @keyup="fetchData()" />
            </div>
          </div>
        </div><!--panel-heading-->
        <div class="panel-body mt-3">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="tblData">
              <tr>
                <th>Invoice (MST)</th>
                <th>Pkg Tracking No</th>
                <th>Sender</th>
                <th>Sender Address</th>
                <th>Sender Phone No.</th>
                <th>Receiver</th>
                <th>Receiver Address</th>
                <th>Receiver Phone No.</th>
                <th>Send To</th>
                <th>Total weight (lbs.)</th>
                <th>No. packages</th>
                <th>Send Date</th>
                <th>Pkg Description</th>
                <!--<th>Note</th>-->
              </tr>
              <tr v-for="row in allData">
                <td><a v-bind:href="'shipping_invoice.php?mst='+row.mst">{{ row.mst}}</a></td>
                <td>MST {{ row.mst}}-{{ row.pkg_tracking_no}}</td>
                <td>{{ row.cust_name}}</td>
                <td>{{ row.cust_address}}, {{ row.cust_city}}, {{ row.cust_state}}, {{ row.cust_zipcode}}</td>
                <td>{{ row.cust_phone}}</td>
                <td>{{ row.recipient_name}}</td>
                <td>{{ row.recipient_address}}</td>
                <td>{{ row.recipient_phone}}</td>
                <td>{{ row.location}}</td>
                <td>{{ row.total_weight}}</td>
                <td>{{ row.num_of_packages}}</td>
                <td>{{ row.send_date}}</td>
                <td>{{ row.package_desc}}</td>
                <!--<td>{{ row.note}}</td>-->
                <!--<td><button type="button" name="edit" class="btn btn-primary btn-xs edit" @click="fetchShippingOrd(row.shipping_order_id)">Edit</button></td>-->

                <!-- <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" @click="deleteData(row.id)">Delete</button></td>-->
              </tr>
              <tr v-if="nodata">
                <td colspan="2" align="center">No Data Found</td>
              </tr>
            </table>
          </div>
        </div><!--panel-body-->
      </div>
    </div><!--searchApp-->
  </div><!--main-content-->
</body>

</html>

<script>
  /** Toggle dashboard */
  $(".toggle-navbar-btn").click(function () {
    $(".navbar-primary").toggle();
  });

  var application = new Vue({
    el: '#searchApp',
    data: {
      allData: '',
      query: '',
      nodata: false,
      date1: new Date((new Date()).valueOf() - 1000 * 60 * 60 * 720).toJSON().slice(0, 10), // 30 days before the current date
      date2: new Date().toJSON().slice(0, 10), // current date
      myModel: false,
      actionButton: 'Insert',
      dynamicTitle: 'Add Data',

    },
    methods: {
      fetchData: function () {
        axios.post('../logic/get_paid_shipping_orders.php', {
          query: this.query,
          date1: this.date1,
          date2: this.date2
        }).then(function (response) {
          if (response.data.length > 0) {
            application.allData = response.data;
            console.log(application.allData);
            application.nodata = false;
          }
          else {
            application.allData = '';
            application.nodata = true;
          }
        });
      },
      fetchShippingOrd: function (shipping_order_id) {
        axios.post('../logic/action.php', {
          action: 'fetchShippingOrd',
          id: shipping_order_id
        }).then(function (response) {
          //application.allData = response.data;
          //console.log(application.allData);
          application.mst = response.data[0].mst;
          application.cust_name = response.data[0].cust_name;
          application.recipient_name = response.data[0].recipient_name;
          application.send_date = response.data[0].send_date;
          application.departure_date = response.data[0].departure_date;
          application.note = response.data[0].note;
          application.hiddenId = response.data[0].shipping_order_id;
          application.myModel = true;
          application.actionButton = 'Update';
          application.dynamicTitle = 'Edit Data';
        });
      },
      submitData: function () {
        /*if(application.mst = '')
        {*/
        if (application.actionButton == 'Insert') {
          axios.post('action.php', {
            action: 'insert',
            firstName: application.first_name,
            lastName: application.last_name
          }).then(function (response) {
            application.myModel = false;
            application.fetchAllData();
            application.first_name = '';
            application.last_name = '';
            alert(response.data.message);
          });
        }
        if (application.actionButton == 'Update') {
          axios.post('../logic/action.php', {
            action: 'update',
            send_date: application.send_date,
            departure_date: application.departure_date,
            note: application.note,
            hiddenId: application.hiddenId
          }).then(function (response) {
            application.myModel = false;
            application.fetchAllData();
            application.first_name = '';
            application.last_name = '';
            application.hiddenId = '';
            alert(response.data.message);
          });
        }
        /*}
        else
        {
          alert("Fill All Field" + application.actionButton);
        }*/
      }
    },
    created: function () {
      this.fetchData();
    }
  });

  function exportTableToExcel(tableID, filename = 'Paid_Shipping_Orders') {
    var table = document.getElementById(tableID);
    var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet1"});
    XLSX.writeFile(wb, filename + ".xlsx");
  }

  function exportToPDF(tableID, title) {
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF('l', 'pt', 'a2'); // Using A2 landscape for many columns
    
    doc.text(title, 40, 40);
    doc.setFontSize(10);
    
    doc.autoTable({
        html: '#' + tableID,
        startY: 60,
        theme: 'grid',
        styles: { fontSize: 7, cellPadding: 2 },
        headStyles: { fillColor: [41, 128, 185], textColor: 255 }
    });
    
    doc.save(title.replace(/ /g, '_') + ".pdf");
  }
</script>