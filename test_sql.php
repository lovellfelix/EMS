<?php

	//if (isset($_POST['submitted'])) { //check for form submission
	//}
	require_once ('./mysqli_connect.php');
	//$q = "SELECT rental_fee, title, category, m_id FROM movie where title='kill bill'";
	$q = "SELECT empid, empfirstname, emplastname FROM employee WHERE (empfirstname='lovell') and (emplastname='felix')";
	$r = @mysqli_query ($dbc, $q);
	
	$num = mysqli_num_rows($r);
	
if ($num > 0) { // If it ran OK, display the records.

	// Print how many Movies Rented there are:
	echo "<p>You Rented $num Movies.</p>\n";

	// Table header.
	echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	<tr><td align="left"><b>Title</b></td><td align="left"><b>Category</b></td><td align="left"><b>Due Date</b></td></tr>
';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['empid'] . '</td><td align="left">' . $row['empfirstname'] . '</td><td align="left">' . $row['emplastname'] . '</td></tr>
		';
	}

	echo '</table>'; // Close the table.
	
	mysqli_free_result ($r); // Free up the resources.	

} else { // If no records were returned.

	echo '<p class="error">There were no movies rented.</p>';

}

mysqli_close($dbc); // Close the database connection.
?>