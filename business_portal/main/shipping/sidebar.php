<?php
// Evaluate basic paths if not provided
$shipping_base_url = isset($shipping_base_url) ? $shipping_base_url : '..';
$shipping_view_url = isset($shipping_view_url) ? $shipping_view_url : '.';
$dashboard_url = isset($dashboard_url) ? $dashboard_url : '../../index.php';
$active_tab = isset($active_tab) ? $active_tab : '';
?>
<nav class="navbar-primary sticky">
  <a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
  <ul class="navbar-primary-menu" id="myTopnav">
    <li>
      <a class="d-flex align-items-center pl-3 text-white text-decoration-none">
        <span class="fs-4">Shipping</span>
      </a>
    </li>
    <li>
      <a href="<?php echo $dashboard_url; ?>" class="nav-link text-white"><i class="icon-dashboard icon-2x"></i>
        Dashboard </a>
    </li>
    <li>
      <a href="<?php echo $shipping_base_url; ?>/index.php"
        class="nav-link text-white <?php echo ($active_tab == 'search_customer') ? 'active' : ''; ?>"> Search
        Customer</a>
    </li>
    <li>
      <a href="<?php echo $shipping_view_url; ?>/shipping_form_online.php"
        class="nav-link text-white <?php echo ($active_tab == 'shipping_form') ? 'active' : ''; ?>"> Shipping Form</a>
    </li>
    <!-- This tab is used to store online shipping order that is submitted from the customer portal website -->
    <!--<li><a href="online_shipping_order.php" class="nav-link text-white"> Online Shipping Orders</a></li>-->
    <!-- This tab is used to store paid shipping order that is submitted from the business portal website -->
    <li>
      <a href="<?php echo $shipping_view_url; ?>/paid_shipping_order.php"
        class="nav-link text-white <?php echo ($active_tab == 'paid_shipping_order') ? 'active' : ''; ?>"> Paid Shipping
        Orders</a>
    </li>
  </ul>
</nav><!--/.navbar-primary-->