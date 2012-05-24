<?php # Script 11.9 - loggedin.php #2

// The user is redirected here from login.php.

session_start(); // Start the session.

//If no session value is present, redirect the user:
if (!isset($_SESSION['empid'])) {
	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url();
	header("Location: $url");
	exit();	
}


$page_title = 'ESSS| You are Logged In!';
include ('./inc/header.html');


 function greet ($name, $msg, $balance, $due){
             	
            if ( (isset($_SESSION['empid'])) && (!strpos($_SERVER['PHP_SELF'], 'logout.php')) ) {
		 	$empID="{$_SESSION['empid']}";
			$username="{$_SESSION['username']}";
		 	$fname="{$_SESSION['empfirstname']}";
			$lname="{$_SESSION['emplastname']}";
		 	$due="{$_SESSION['e']}";
			$msg ="your account balance is";
			
                }
				
             echo "<p>Hi $fname, You are now logged in ESSS Local Intranet.</p>";
			 echo " <br >
			 <hr> <br >
			 <b><u>CONTROL PANEL<u><b> <br > <br >
			 <a href='edit_profile.php?id=$empID'>Update My Profile</a><br>
			 <a href='employees.php'>View Employee Directory</a><br>
			  <a href='search.php'>Employee Lookup</a><br>";
			if ($_SESSION['role']=="1")  {
			echo "<br><u>ADMIN MENU<u><br><br>
			<a href='HR-functions.php'>Human Resource</a><br>
			<a href='management.php'>Management</a><br > <br>";
			 } else { 
			 echo '<br> <br>';}
             }
             greet("$name", "$balance","$due", "msg");
			 
echo '</ul></div>';			 
include './inc/sidebar.html';              		
include ('./inc/footer.html');?>