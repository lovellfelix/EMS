<?php 

// This page is for editing a user record.
// This page is accessed through view_users.php.
// The user is redirected here from login.php.

session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['empid'])) {
	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url('login.php');
	header("Location: $url");
	exit();	
}
$page_title = 'EMS - User Profile';
include ('inc/header.php');

echo '<h1>' . $row[0] . ' ' . $row[1] . '</h1>';

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


// Retrieve the user's information:
$q = "SELECT employee.empid, employee.empfirstname, employee.empsup, employee.empjobtitle, 
employee.empnickname, employee.emplastname, employee.empstreetaddress, employee.empcity, 
employee.empstate, employee.empzip, employee.empofficephone, employee.emphomephone, 
employee.empmaritalstatus, employee.empdob, employee.empssn, user.username, user.password, user.role,
unitedway.empid, unitedway.uwid, unitedway.uwyear, unitedway.uwtype, CONCAT(  '$', FORMAT( unitedway.uwamount, 2 ) ) As uwamount FROM employee, user, unitedway WHERE employee.empid=$id AND user.empid=$id 
";	

$r = @mysqli_query ($dbc, $q);
//$rl = @mysqli_query ($dbc, $rl);
if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
	
	//setting phone number as a string
	//$love= 'lovell';
	//$homephone = $_row['empid'];
	//echo "$homephone, $love";
	// display information about user
	 //$home = $row['empfirstname'];
		echo ' <h1> '. $row['empfirstname'].' '. $row['emplastname'].', Profile </h1>
		<br>Nickname: '. $row['empnickname'] . ' <br> <hr> 
		<br ><b>Job Title: </b>'. $row['empjobtitle'] . ' <br>
		<b>Supervisor: </b>'. $row['empsup'] . ' <br > <br >
		
		 <p><b><u>Contact Information</u> </b> </b> <br > <br ></em>
		<b>Address: </b> '. $row['empstreetaddress'] . ', <br />' . $row['empcity'] . ', ' . $row['empstate'] . ' ' . $row['empzip'] . '. <br />  <br />
		<b>Telephone: </b> <br>Work:  ' . $row['empofficephone'] . ' <br />
		Home: </b>  ' . $row['emphomephone'] . '<br>';
		
		// view united way contribution	
		
		if (($_SESSION['role']=="$id") ||($_SESSION['role']==1))  {
	echo '<hr> <br><font color= color="#FF0000"><u><b>UNITEDWAY Contribution</u></b></font><br>';

	echo '<table align="center" cellspacing="1" cellpadding="4" width="100% ">
<br><tr>
	<td align="left"><b>UWID</b></td>
	<td align="left"><b>Year</b></td>
	<td align="left"><b>Type</b></td>
	<td align="left"><b>Amount</b></td>
</tr>';

// Fetch and print all the records....
$bg = '#ffffff'; 
//while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#ffffff' ? '#eeeeee' : '#ffffff');
		echo '
		<tr bgcolor="' . $bg . '">
		<td align="left">  ' . $row['uwid'] . '</td>
		<td align="left"> ' . $row['uwyear'] . '</td>
		<td align="left"> ' . $row['uwtype'] . '</td>
		<td align="left">' . $row['uwamount'] . '</td>
		
				
	</tr></table></br>
	';

echo '</p>';
} else {
	echo '';


	}
	
if (($_SESSION['role']=="$id") || ($_SESSION['role']==1)){
	echo '<br><center>******ADMIN VIEW******</center><hr>
		
		<div align="right"><p>Maritial Status: ' . $row['empmaritalstatus'] . ' <br >
		<p>Date Of Birth #: '. $row['empdob'] . '</p></div>
<p>Social Security #: '. $row['empssn'] . '</p>

<br> <strong>Login Crendential</strong> <br> <br>
<p>User Name: ' . $row['username'] . ' <br>
Role: '. $row['role'] . '</p>';
} else {

	echo '';

}
	
echo '<p> <a href="employees.php"> Return to Employee Directory</a> * <a href="edit_profile.php?id=' . $row['empid'] . '">Edit</a> * 	</a> * <a href="delete_profile.php?id=' . $row['empid'] . '">Delete</a> * <a href="logout.php"></a></p>
';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
		
include ('inc/footer.php');
?>
