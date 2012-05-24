<?php # Script 11.2 - login_functions.inc.php

// This page defines two functions used by the login/logout process.

/* This function determines and returns an absolute URL.
 * It takes one argument: the page that concludes the URL.
 * The argument defaults to index.php.
 */
function absolute_url ($page = 'index.php') {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');
	
	// Add the page:
	$url .= '/' . $page;
	
	// Return the URL:
	return $url;

} // End of absolute_url() function.


/* This function validates the form data (the email address and password).
 * If both are present, the database is queried.
 * The function requires a database connection.
 * The function returns an array of information, including:
 * - a TRUE/FALSE variable indicating success
 * - an array of either errors or the database result
 */
function check_login($dbc, $username = '', $password = '') {

	$errors = array(); // Initialize error array.
	
	// Validate the email address:
	if (empty($username)) {
		$errors[] = 'You forgot to enter your username.';
	} else {
		$u = mysqli_real_escape_string($dbc, trim($username));
	}
	
	// Validate the password:
	if (empty($password)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($password));
	}

	if (empty($errors)) { // If everything's OK.

		// Retrieve the user_id and first_name for that email/password combination:
		//$q = "SELECT movie.title, movie.category, customer.fname, customer.lname, rental.due_date FROM customer, movie, rental WHERE (movie.m_id=rental.m_id) and (customer.c_id=rental.c_id) and  (customer.fname='janet') and (customer.lname='akers')";

//$q = "SELECT empid, username, password, role FROM user WHERE (username='$u' AND password=SHA1('$p'))";	

$q = "SELECT user.empid, user.username, user.password, user.role, employee.empid, employee.empfirstname, employee.emplastname FROM user, employee WHERE (employee.empid=user.empid) and (user.username='$u' AND user.password=SHA1('$p'))";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		
		// Check the result:
		if (mysqli_num_rows($r) == 1) {
		
			// Fetch the record:
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
			
			// Return true and the record:
			return array(true, $row);
			
		} else { // Not a match!
			$errors[] = 'The username and password entered do not match those on file.';
		}
		
	} // End of empty($errors) IF.
	
	// Return false and the errors:
	return array(false, $errors);

} // End of check_login() function.

?>
