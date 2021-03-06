<?php 

// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.
session_start(); // Access the existing session.
$page_title = 'EMS- Report-Salary Employees';
include ('inc/header.php');
echo '<h2><small>REPORT MENU: United Way Contribution by Employees</h2> </small><br /> <hr> <br />';

require_once ('./mysqli_connect.php');

// Number of records to show per page:
$display = 22;

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
		$order_by = 'uwyear ASC ';
		break;
	case 't':
		$order_by = 'empfirstname ASC';
		break;
	case 'c':
		$order_by = 'emplastname ASC';
		break;
	default:
		$order_by = 'uwyear ASC';
		$sort = 't';
		break;
}
	
// Make the query:
//$q = "SELECT empfirstname, emplastname, empjobtitle, empid, empofficephone FROM employee ORDER BY $order_by LIMIT $start, $display";		
$q = "SELECT unitedway.empID, unitedway.UWYear, employee.empid, CONCAT(  '$', FORMAT( unitedway.UWAmount, 2 ) ) AS UWAmount, employee.empfirstname, employee.emplastname FROM unitedway, employee WHERE (employee.empid=unitedway.empid)";		

$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo '<table align="center" cellspacing="5" cellpadding="5" width="100%">

<tr>
	<td align="left"><b><a href="unitedway.php?sort=t">First Name</a></b></td>
	<td align="left"><b><a href="unitedway.php?sort=c">Last Name</a></b></td>
	<td align="left"><b><a href="unitedway.php?sort=rf">Year</a></b></td>
	<td align="left"><b><a href="unitedway.php?sort=rf">Contribution Amount</a></b></td>
	<td align="left"><b>Profile</b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '
		<tr bgcolor="' . $bg . '">
		<td align="left">' . $row['empfirstname'] . '</td>
		<td align="left">' . $row['emplastname'] . '</td>
		<td align="left">' . $row['UWYear'] . '</td>
		<td align="center">' . $row['UWAmount'] . '</td>
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
		echo '<a href="unitedway.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="unitedway.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="unitedway.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
	
include ('inc/footer.php');
?>
