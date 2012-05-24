<?php # Script 9.5 - #5

// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.
// The user is redirected here from login.php.

session_start(); // Start the session.

//If no session value is present, redirect the user:
if (!isset($_SESSION['empid'])) {
	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url('login.php');
	header("Location: $url");
	exit();	
}
$page_title = 'ESSS| Employee Directory';
include ('inc/header.html');
echo '<h1>List of Employees</h1> <br /> <hr> <br />';

require_once ('./mysqli_connect.php');

// Number of records to show per page:
$display = 20;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(empid) FROM employee";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'rf':
		$order_by = 'empfirstname ASC';
		break;
	case 't':
		$order_by = 'emplastname ASC';
		break;
	case 'c':
		$order_by = 'empjobtitle ASC';
		break;
	default:
		$order_by = 'empfirstname ASC';
		$sort = 't';
		break;
}
	
// Make the query:
$q = "SELECT empfirstname, emplastname, empjobtitle, empid, empofficephone FROM employee ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo '<table align="center" cellspacing="1" cellpadding="4" width="100%">

<tr>
	<td align="left"><b><a href="employees.php?sort=rf">First Name</a></b></td>
	<td align="left"><b><a href="employees.php?sort=t">Last Name</a></b></td>
	<td align="left"><b><a href="employees.php?sort=c">Job Title</a></b></td>
	<td align="left"><b><a href="employees.php?sort=rf">Contact Number</a></b></td>
	<td align="left"><b>Profile</b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '
		<tr bgcolor="' . $bg . '">
		<td align="left">  ' . $row['empfirstname'] . '</td>
		<td align="left"> ' . $row['emplastname'] . '</td>
		<td align="left">' . $row['empjobtitle'] . '</td>
		<td align="left">' . $row['empofficephone'] . '</td>
		<td align="left"><a href="view_profile.php?id=' . $row['empid'] . '">VIEW</a></td>
		
	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="employees.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="employees.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="employees.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
echo '</div>';
//include './inc/sidebar.html'; 	
include ('inc/footer.html');
?>
