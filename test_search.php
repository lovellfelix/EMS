<?php # Script 8.7 - password.php
// This page lets a user change their password.

$page_title = 'ESSS| Search Reasults';
include ('./inc/header.html');

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	require_once ('./mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['fname'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['fname']));
	}
	
	// Check for the current password:
	if (empty($_POST['lname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['lname']));
	}

	// Check for a new password and match 
	// against the confirmed password:

	
	if (empty($errors)) { // If everything's OK.
	
		// Check that they've entered the right email address/password combination:
			//$q = "SELECT empfirstname, emplastname, empjobtitle FROM employee WHERE (empfirstname='$fn') AND (emplastname='$ln')";
			$q = "SELECT empid, empfirstname, emplastname FROM employee WHERE (empfirstname='$fn') and (emplastname='$ln')";

			$r = @mysqli_query ($dbc, $q);
			$num = mysqli_num_rows($r);
		if ($num > 0) { // Match was made.
		
			// Get the user_id:
			$row = mysqli_fetch_array($r, MYSQLI_NUM);

			// Make the UPDATE query:
			if ($num > 0) { // If it ran OK, display the records.
			// Print how many Movies Rented there are:
	 		echo "<p>Your search results.</p> <hr>";

	// Table header.
	echo '<table align="center" cellspacing="3" cellpadding="3" width="100%">
	<tr><td align="left"><b>First Name</b></td><td align="left"><b>Last Name</b></td><td align="left"><b>Job title</b></td></tr> <br />
';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left"><a href="profile.php?id=' . $row['empid'] . '">' . $row['empfirstname'] . '</td><td align="left">' . $row['EmpLastname'] . '</td><td align="left">' . $row['empjobtitle'] . '</td></tr>
				';

	}

	echo '</table>'; // Close the table.
			
				// Public message:
				echo ''; 
				
				// Debugging message:
				
				
			}

			// Include the footer and quit the script (to not show the form).
			include ('./inc/footer.html'); 
			exit();
				
		} else { // Invalid email address/password combination.
			echo '<h1>Error!</h1>
			<p class="error">The first name and last name do not match those on file.</p>';
		}
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
include ('./inc/search.html');	
include ('./inc/footer.html');
?>
