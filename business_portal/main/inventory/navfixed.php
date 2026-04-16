<style>.top-sticky { z-index: 1050 !important; }</style>
<nav class="navbar navbar-inverse navbar-global navbar-fixed-top top-sticky">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Vietstar Shipping</a>
			<ul class="nav nav-user pull-right"><!-- navbar-nav -->
				<li><a href="#"><i class="icon-user icon-large"></i> Welcome
						<?php echo isset($name) ? htmlspecialchars($name) : (isset($_SESSION['SESS_NAME']) ? htmlspecialchars($_SESSION['SESS_NAME']) : 'User'); ?>!</a>
				</li>
				<li><a href="../../logout.php"><i class="icon-off icon-large"></i> Log Out</a></li>
			</ul>
		</div>
	</div>
</nav><!--navbar navbar-inverse navbar-global navbar-fixed-top-->