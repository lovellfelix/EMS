<?php # Script 11.9 - loggedin.php #2

//The user is redirected here from login.php.

session_start(); // Start the session.

//If no session value is present, redirect the user:
if (!isset($_SESSION['empid'])) {
	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url('login.php');
	header("Location: $url");
	exit();	
}


$page_title = 'ESSS| HR- Functions!';
include ('./inc/header.html');


if ($_SESSION['role']=="1")  {
			echo '<h2>HR FUNCTIONS</h2><br><hr>	
			<br>Manage USER: Employees <br /><br />
<ul class="linklist">
					<li class="first"><a href="#"></a></li>
					<li><a href="employees.php">View Employees</a></li>
                    <li><a href="addnew.php">Add Employee</a></li>
                   <li><a href="search.php">Search Employee Directory</a></li>
					
				</ul> <br />';
			 
echo '<h2><small>REPORT MENU: </h2> </small><br /> <hr> <br />
<ul class="linklist">
					<li class="first"><a href="#"></a></li>
					<li><a href="deduction.php"> Employees Deduction</a></li>
					<li><a href="report-maxhour-hourlyrate.php">Maximum Hours & Pay Rate of Hourly workers</a></li>
                    <li><a href="report-salary-employees.php">List of Employee recieving Annual Salary</a></li>
                   
					
				</ul> <br /> <br />';
			 } else { 
			 echo '<h2>Human Resource Function</h2> <br><hr> <br><br><center><font color= color="#FF0000">*****ACCESS DENIED***** <br><br> You don\'t have permission to view this page </center><br> ';}
           
echo  '</div>';			 
include './inc/sidebar.html';             		
include ('./inc/footer.html');
?>