<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo $page_title; ?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />

		<!-- Le styles -->
		<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="assets/css/google-buttons.css" rel="stylesheet" type="text/css">
		<link href="assets/css/labs.css" rel="stylesheet" type="text/css">
	    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet" type="textcss">
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="assets/img/grav.png">
	</head>

	<body data-spy="scroll" data-target=".subnav" data-offset="50">

		<!-- Navbar
		================================================== -->
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">

					<ul class="nav">
						<li>
							<a href="/">labs · Lovell Felix</a>
						</li>
					</ul>
					 <div class="nav-collapse">
					<ul class="nav">
						</ul>
						<ul class="nav pull-right">
						
			<li class="dropdown">
				<p class="dropdown-toggle navbar-text" data-toggle="dropdown" id="userDrop">
				<?php $username="{$_SESSION['username']}"; ?>
					  <?php if ( (isset($_SESSION['empid'])) && (!strpos($_SERVER['PHP_SELF'], 'logout.php')) ) {
	echo '<div class="btn-group">
  <a class="btn" href="#">'; echo $username; echo '</a>
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="#"><i class="icon-pencil"></i> Edit Profile</a></li>
    <li><a href="#"><i class="icon-trash"></i> Reports</a></li>
    <li class="divider"></li>
    <li><a href="logout.php"><i class="i"></i> Logout</a></li>
  </ul>
</div>';
				} else {
	echo '<a href="login.php">Login?</a>';
}
?>
			</div>
				</div>
				
			</div>
		</div>

		<div class="container">

			<!-- Navigation list
			================================================== -->
			<div class="inner">
				<div class="page-header jumbotron masthead">
					<h1>labs</h1><small>
						<blockquote>
						EMPLOYEE MANAGEMENT SYSTEM	
					</small></blockquote>
				</div>
<?php include_once ('inc/breadcrumbs.php'); ?>	
	<div class="row">
				<div class="span3">
				<?php include_once ('inc/nav.php'); ?>
				<?php include_once ('inc/sidebar.php'); ?>
				</div>
				<div class="span9"><div class="bs-post">
</head>

<body>

		

		
		
		