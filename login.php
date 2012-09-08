<?php 

if (isset($_POST['submitted'])) {

	require_once ('./inc/login_functions.inc.php');
	require_once ('./mysqli_connect.php');
	list ($check, $data) = check_login($dbc, $_POST['username'], $_POST['password']);
	
	if ($check) { // OK!
			
		// Set the session data:.
		session_start();
		$_SESSION['empid'] = $data['empid'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['empfirstname'] = $data['empfirstname'];
		$_SESSION['role'] = $data['role'];
		$_SESSION['EmplastName'] = $data['Emplastname'];// Store the HTTP_USER_AGENT:
		$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);
		
		// Redirect:
		$url = absolute_url ('control-panel.php');
		header("Location: $url");
		exit();
			
	} else { // Unsuccessful!
		$errors = $data;
	}
		
	mysqli_close($dbc);

} // End of the main submit conditional.

include ('./inc/login_page.inc.php');

?>
