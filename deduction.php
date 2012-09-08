<?php 

session_start(); // Access the existing session.
$page_title = 'ESSS| Report-Employee Deductions';
include ('inc/header.php');
echo '<h2><small>REPORT MENU: Deductions</h2> </small><br /> <hr> <br />';

require_once ('./mysqli_connect.php');

// Number of records to show per page:
$display = 30;

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
	case 'dn':
		$order_by = 'dedname ASC';
		break;
	case 'fn':
		$order_by = 'employee.empfirstname ASC';
		break;
	case 'ln':
		$order_by = 'employee.emplastname ASC';
		break;
	default:
		$order_by = 'miscdeduction.DeDRequestDate ASC';
		$sort = 'rd';
		break;
}
	
// Make the query:
		
$q = "SELECT miscdeduction.empid, miscdeduction.DeDRequestDate, miscdeduction.dedname,
miscdeduction.dedfrequency, 	
 CONCAT(  '$', FORMAT( miscdeduction.dedamount, 2 ) ) As amount, 
employee.empid, employee.empfirstname, employee.emplastname FROM 
miscdeduction, employee WHERE (employee.empid=miscdeduction.empid)";		

$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo '<table align="center" cellspacing="5" cellpadding="5" width="100%">

<tr>
	<td align="left"><b><a href="deduction.php?sort=fn">First Name</a></b></td>
	<td align="left"><b><a href="deduction.php?sort=ln">Last Name</a></b></td>
	<td align="left"><b><a href="deduction.php?sort=rd">Request Date</a></b></td>
	<td align="left"><b><a href="deduction.php?sort=dn">Deduction Type</a></b></td>
	
	
	<td align="left"><b>Amount</b></td>
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
		<td align="left">' . $row['DeDRequestDate'] .'</td>
		<td align="left">' . $row['dedname'] .'</td>
		<td align="left">' . $row['amount'] .'</a></td>
		
	</tr>
	';
} // End of WHILE loop.

echo '</table> <br><br>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="deduction.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="deduction.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="deduction.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p><hr class="soften">'; // Close the paragraph.
	
} // End of links section.
	
include ('inc/footer.php');
?>
