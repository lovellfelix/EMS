<?php # 

$page_title = 'Add United Way | ESSS';
include ('inc/header.php');

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	$errors = array(); // Initialize an error array.
	
	// Check for a empid:
	if (empty($_POST['empid'])) {
		$errors[] = 'You forgot to enter united way ID.';
	} else {
		$empid = trim($_POST['empid']);
	}
	
	// Check for a id:
	if (empty($_POST['id'])) {
		$errors[] = 'You forgot to enter united way ID.';
	} else {
		$id = trim($_POST['id']);
	}
	
	// Check for a year:
	if (empty($_POST['year'])) {
		$errors[] = 'You forgot to enter united way year.';
	} else {
		$y = trim($_POST['year']);
	}
	
	// Check for a type:
	if (empty($_POST['type'])) {
		$errors[] = 'You forgot to enter united way type.';
	} else {
		$t = trim($_POST['type']);
	}
	
	// Check for a amount:
	if (empty($_POST['amount'])) {
		
			$errors[] = 'You forgot to enter united way amount.';
		} else {
			$a = trim($_POST['amount']);
		}
	
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		require_once ('./mysqli_connect.php'); // Connect to the db.
		
		// Make the query:
		$q = "INSERT INTO unitedway (uwid, uwyear, uwtype, uwamount, empid) VALUES ('$id', '$y', '$t', '$a', '$empid' )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1> <br> <hr> <br>
		<p>United Way Added successfully!</p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.
		
		// Include the footer and quit the script:
		include ('./inc/footer.html'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.

} // End of the main Submit conditional.
?>
<h1>Setup New United Way Plan! <br /></h1>
<br />
<hr >
<br />
<form action="add_united.php" method="post">
	<br><p>Employee ID: <input type="text" name="empid" size="14" maxlength="20" value="<?php if (isset($_POST['empid'])) echo $_POST['empid']; ?>" />
	United Way ID: <input type="text" name="id" size="14" maxlength="20" value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>" /></p>
	<br><p>Year: <input type="text" name="year" size="4" maxlength="40" value="<?php if (isset($_POST['year'])) echo $_POST['year']; ?>" />
	Type: <input type="listbox" name="type" size="12" maxlength="40" value="<?php if (isset($_POST['type'])) echo $_POST['type']; ?>" />
	Amount: <input type="text" name="amount" size="14.5" maxlength="40" value="<?php if (isset($_POST['amount'])) echo $_POST['amount']; ?>" />
	</p><br>
	<p><input  type="submit" name="submit" size="15" value="Submit" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
<br />

<?php
echo '</div>';

include ('./inc/footer.php');
?>
