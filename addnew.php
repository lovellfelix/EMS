<?php 
session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['empid'])) {
	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url('login.php');
	header("Location: $url");
	exit();	
}
$page_title = 'Register';
include ('inc/header.php');


require_once ('./mysqli_connect.php'); 

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	$errors = array();
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter a first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter a last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	// Check for an Nickname:
	if (empty($_POST['nick_name'])) {
		$errors[] = 'You forgot to enter a Nickname.';
	} else {
		$nn = mysqli_real_escape_string($dbc, trim($_POST['nick_name']));
	}
	// Check for an date birth
	if (empty($_POST['dob'])) {
		$errors[] = 'You forgot to enter a date of birth.';
	} else {
		$dob = mysqli_real_escape_string($dbc, trim($_POST['dob']));
		
	}
	// Check for a Social Security Number:
	if (empty($_POST['social'])) {
		$errors[] = 'You forgot to enter a Social Security Number';
	} else {
		$sn = mysqli_real_escape_string($dbc, trim($_POST['social']));
	}
	// Check for home phone:
	if (empty($_POST['home_phone'])) {
		$errors[] = 'You forgot to enter a home phone number.';
	} else {
		$hp = mysqli_real_escape_string($dbc, trim($_POST['home_phone']));
	}
	// Check for Marital Status:
	if (empty($_POST['marital_status'])) {
		$errors[] = 'You forgot to enter a marital status.';
	} else {
		$ms = mysqli_real_escape_string($dbc, trim($_POST['marital_status']));
	}
	
	// Check for street address:
	if (empty($_POST['street_address'])) {
		$errors[] = 'You forgot to enter street address.';
	} else {
		$sa = mysqli_real_escape_string($dbc, trim($_POST['street_address']));
	}
	
		// Check for a state:
	if (empty($_POST['state'])) {
		$errors[] = 'You forgot to enter a state.';
	} else {
		$s = mysqli_real_escape_string($dbc, trim($_POST['state']));
	}
		// Check for zip:
	if (empty($_POST['zip'])) {
		$errors[] = 'You forgot to enter zipcode.';
	} else {
		$z = mysqli_real_escape_string($dbc, trim($_POST['zip']));
	}
		// Check for an job title
	if (empty($_POST['job_title'])) {
		$errors[] = 'You forgot to enter job title.';
	} else {
		$jb = mysqli_real_escape_string($dbc, trim($_POST['job_title']));
	}
		// Check for an office phone:
	if (empty($_POST['office_phone'])) {
		$errors[] = 'You forgot to enter a office phone.';
	} else {
		$op = mysqli_real_escape_string($dbc, trim($_POST['supervisor']));
	}
		// Check for an office phone:
	if (empty($_POST['supervisor'])) {
		$errors[] = 'You forgot to enter a office phone.';
	} else {
		$sup = mysqli_real_escape_string($dbc, trim($_POST['supervisor']));
	}
	
			// Check for username:
	if (empty($_POST['user_name'])) {
		$errors[] = 'You forgot to enter a username.';
	} else {
		$un = mysqli_real_escape_string($dbc, trim($_POST['user_name']));
	}
		// Check for password:
	if (empty($_POST['password'])) {
		$errors[] = 'You forgot to enter a password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['password']));
	}
	
		// Check for department:
	if (empty($_POST['department'])) {
		$errors[] = 'You forgot to enter department.';
	} else {
		$dpt = mysqli_real_escape_string($dbc, trim($_POST['department']));
	}
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		require_once ('../mysqli_connect.php'); // Connect to the db.
		
		// Make the query:
		$q = "INSERT INTO employee(empfirstname, emplastname, empnickname, empssn, emphomephone
								   empstreetaddress, empstate, empzip, empdob, empmaritalstatus, empofficephone,
								   empjobtitle, empsup) VALUES ('$fn', '$ln', '$nn', '$sn', '$hp', ('$s'),
								   '$z', '$dob', '$ms', '$op', '$jb', '$sup'";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>New Employee was added!</p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.
		
		// Include the footer and quit the script:
		include ('includes/footer.html'); 
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
<h1> Add New Employee </h1> <br /><hr />
<br /><b><u></b>Personal Information</u><br> <br>
	<form action="edit_profile.php" method="post">
<p>First Name: <input type="text" name="first_name" size="15" maxlength="15" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /> 
Last Name: <input type="text" name="last_name" size="19.5" maxlength="30" value="<?php if (isset($_POST['last_name'])) echo $_POST['first_name']; ?>" /></p>
<p>Nick Name: <input type="text" name="nick_name" size="15" maxlength="30" value="<?php if (isset($_POST['nick_name'])) echo $_POST['nick_name']; ?>" /> Maritial Status: <input type="text" name="marital_status" size="16" maxlength="30" value="<?php if (isset($_POST['marital_status'])) echo $_POST['marital_status']; ?>" /></p>
<p>Date of Birth: <input type="text" name="dob" size="13" maxlength="30" value="<?php if (isset($_POST['dob'])) echo $_POST['dob']; ?>" /></P>
<p>Social Security #: <input type="text" name="social" size="9" maxlength="30" value="<?php if (isset($_POST['social'])) echo $_POST['social']; ?>" /></p>

Home Phone: <input type="text" name="home_phone" size="13" maxlength="30" value="<?php if (isset($_POST['home_phone'])) echo $_POST['home_phone']; ?>" /></p>
<p>Street Address: <input type="text" name="street_address" size="" maxlength="30" value="<?php if (isset($_POST['street_address'])) echo $_POST['first_name']; ?>"  /> 
State: <input type="text" name="state" size="2" maxlength="30" value="<?php if (isset($_POST['state'])) echo $_POST['state']; ?>"  />  Zip: <input type="text" name="zip" size="2" maxlength="30" value="<?php if (isset($_POST['zip'])) echo $_POST['zip']; ?>"  /></p>
</p>
<br>
<u>Company Information</u> <br>	<br>

<p>Job Title: <input type="text" name="job_title" size="23" maxlength="15" value="<?php if (isset($_POST['job_title'])) echo $_POST['job_title']; ?>" /> 
Office Phonee: <input type="text" name="officephone" size="10" maxlength="30" value="<?php if (isset($_POST['officephone'])) echo $_POST['officephone']; ?>" /></p>

<p>Supervisor: <input type="text" name="supervisor" size="15" maxlength="30" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" />
Department #: <input type="text" name="Department" size="15" maxlength="30" value="<?php if (isset($_POST['department'])) echo $_POST['department']; ?>" /></p>
<p>User Name: <input type="text" name="username" size="15" maxlength="30" value="<?php if (isset($_POST['user_name'])) echo $_POST['user_name']; ?>" />
Password: <input type="password" name="password" size="20" maxlength="30" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" /></p>
<hr> <br>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="submitted" value="TRUE" />
<input type="hidden" name="id" value="' . $id . '" />
</form>
<br> <br>
<?php
include ('inc/footer.php');
?>
