<?php # Script 11.11 - logout.php #2
// This page lets the user logout.

session_start(); // Access the existing session.

// If no session variable exists, redirect the user:
if (!isset($_SESSION['empid'])) {

	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url();
	header("Location: $url");
	exit();

} else { // Cancel the session.

	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.

}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';
include ('./inc/header.html');

// Print a customized message:
echo "<h1>Logged Out!</h1> <br /> <hr>
<br />
<p>You are now logged out!</p> <br> </div>";

include ('./inc/sidebar.html');
include ('./inc/footer.html');
?>
