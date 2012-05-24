<?php # Script 9.3 - edit_user.php

// This page is for editing a user record.
// This page is accessed through view_users.php.
session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['empid'])) {
	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url('login.php');
	header("Location: $url");
	exit();	
}
$page_title = 'ESSS| Edit User Profile';
include ('./inc/header.html');

echo '<h1>Update User Profile</h1> <br > <hr> <br>';

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('inc/footer.html'); 
	exit();
}

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
		$op = mysqli_real_escape_string($dbc, trim($_POST['office_phone']));
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
	
		//  Test for username address:
		//$q = "SELECT empid FROM employee WHERE empfirstname='$fn' AND empid != $id";
		$q = "SELECT empid FROM user WHERE username='$un' AND empid != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			//$q = "UPDATE user SET username='$fn' where empid=$id";
			
			$q = "UPDATE employee INNER JOIN user USING (empid) INNER JOIN department USING (empid) SET employee.empfirstname='$fn',
			emplastname='$ln', empnickname='$nn', user.username='$un', department.deptname='$dpt',
			emphomephone='$hp', empstreetaddress='$sa', empstate='$s', empzip='$z', empdob='$dob', empssn='$sn',empmaritalstatus='$ms', user.password=SHA1('$p'),
			empofficephone='$op', empjobtitle='$jb', empsup='$sup' WHERE empid=$id";
			
			//$q = "UPDATE employee INNER JOIN user USING (empid) SET employee.empfirstname='$fn', user.username='$un' WHERE empid=$id";
			//$q = "UPDATE employee INNER JOIN user USING (empid) INNER JOIN department USING (empid) SET empfirstname='$fn', 
			//emplastname='$ln', empnickname='$nn', empdob='$dob', empssn='$sn', 
			//user.username='$un' department.deptName='$dpt' WHERE empid=$id";
			
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
			
				// Print a message:
				echo '<p>The user Profile has been edited.</p>';	
							
			} else { // If it did not run OK.
				echo '<p>The user Profile has been edited.</p>'; // Public message.
				//echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		} else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
		}
		
	} else { // Report the errors.
	
		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
		
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$q = "SELECT employee.empid, employee.empfirstname, employee.empsup, employee.empjobtitle, employee.empnickname, employee.emplastname, employee.empstreetaddress, employee.empcity, employee.empstate, employee.empzip, employee.empofficephone, employee.emphomephone, employee.empmaritalstatus, employee.empdob, employee.empssn, user.username, user.password, user.role, department.DeptName FROM department, employee, user WHERE employee.empid=$id AND user.empid=$id AND department.empid=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
 
	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
	
	// Create the form:
	
	echo ' <b><u></b>Personal Information</u><br> <br>
	<form action="edit_profile.php" method="post">
<p>First Name: <input type="text" name="first_name" size="15" maxlength="15" value="' . $row['empfirstname'] . '" /> 
Last Name: <input type="text" name="last_name" size="19.5" maxlength="30" value="' . $row['emplastname'] . '" /></p>
<p>Nick Name: <input type="text" name="nick_name" size="15" maxlength="30" value="' . $row['empnickname'] . '" /> Maritial Status: <input type="text" name="marital_status" size="16" maxlength="30" value="' . $row['empmaritalstatus'] . '" /></p>
<p>Date of Birth: <input type="text" name="dob" size="13" maxlength="30" value="' . $row['empdob'] . '" /></P>
<p>Social Security #: <input type="text" name="social" size="9" maxlength="30" value="' . $row['empssn'] . '" /></p>

Home Phone: <input type="text" name="home_phone" size="13" maxlength="30" value="' . $row['emphomephone'] . '" /></p>
<p>Street Address: <input type="text" name="street_address" size="" maxlength="30" value="' . $row['empstreetaddress'] . '"  /> 
State: <input type="text" name="state" size="2" maxlength="30" value="' . $row['empstate'] . '"  />  Zip: <input type="text" name="zip" size="2" maxlength="30" value="' . $row['empzip'] . '"  /></p>
</p>
<br>
<u>Company Information</u> <br>	<br>

<p>Job Title: <input type="text" name="job_title" size="23" maxlength="15" value="' . $row['empjobtitle'] . '" /> 
Office Phonee: <input type="text" name="office_phone" size="10" maxlength="30" value="' . $row['empofficephone'] . '" /></p>
<p>Supervisor: <input type="text" name="supervisor" size="15" maxlength="30" value="' . $row['empsup'] . '" />
Department #: <input type="text" name="department" size="15" maxlength="30" value="' . $row['DeptName'] . '" /></p>
<p>User Name: <input type="text" name="user_name" size="15" maxlength="30" value="' . $row['username'] . '" />
Password: <input type="password" name="password" size="20" maxlength="30" value="' . $row['password'] . '" /></p>
<hr> <br>
<p><input type="submit" name="submit" value="UPDATE" /></p>
<input type="hidden" name="submitted" value="TRUE" />
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
		
include ('inc/footer.html');
?>
