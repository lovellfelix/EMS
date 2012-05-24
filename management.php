<?php # Script 8.3 - register.php
// The user is redirected here from login.php.

session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['empid'])) {
	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url('login.php');
	header("Location: $url");
	exit();	
}
$page_title = 'ESSS| Management Menu';
include ('inc/header.html');

if ($_SESSION['role']=="1")  {
			echo '<h2><small>Manage United Way: Employees </h2> </small><br /> <hr> <br />
<ul class="linklist">
<li><a href="unitedway.php">View United Way Contribution</a></li>
<li><a href="add_united.php">Add United Way</a></li> </ul><br />';
 } else { 
echo '<h2>Management Menu</h2> <br><hr> <br><br><center><font color= color="#FF0000">*****ACCESS DENIED***** <br><br> You don\'t have permission to view this page </center><br></div>  ';}
           
echo '</div>';			 
include './inc/sidebar.html';
include ('./inc/footer.html');
?>