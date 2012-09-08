<?php 

// The user is redirected here from login.php.

session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['empid'])) {
	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url('login.php');
	header("Location: $url");
	exit();		
}
$page_title = 'EMS - Employee Profile';
include ('./inc/header.php');

echo '<h3>Messages View</h3> <br />';



// Always show the form...

// Retrieve the user's information:
$q = "SELECT empfirstname, emplastname FROM employee WHERE empid=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_ASSOC	);
	
	// Create the form:
	echo '<form action="delete_message.php" method="post">
<p><b>First Name:</b> ' . $row['empfistname'] . '</p>
<p><b>Last Name:</b> ' . $row['emplastname'] . ' </p>
<p><b>Email Address:</b> ' . $row['empstreetaddress'] . ' </p>
<p><b>Message:</b> ' . $row['message'] . '</p>
<div></div>
<p> <a href="messages.php"> Return to Inbox
</a> * <a href="delete_message.php?id=' . $row['empid'] . '">Delete</a> * 	
<a href="logout.php"> LogOut </a></p>
<input type="hidden" name="submitted" value="TRUE" />
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { // Not a valid user ID.

echo '<p class="error">This page has been accessed in error.</p>';


mysqli_close($dbc);
}
		
include ('inc/footer.php');
?>