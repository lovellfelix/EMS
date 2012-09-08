<?php 

session_start(); // Start the session.

//If no session value is present, redirect the user:
if (!isset($_SESSION['empid'])) {
	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url('login.php');
	header("Location: $url");
	exit();	
}


$page_title = 'EMS - HR Functions!'; $crumbs = "EMS"; $pageurl = "/"; $subCrumbs = "HR FUNCTIONS"; $subCrumbsurl ="HR-functions.php";
include ('./inc/header.php');


if ($_SESSION['role']=="1")  {
			echo '<button class="btn btn-large btn-info" type="button"><i class="icon-cog icon-white"></i> </button><br /> <hr class="soften">	
			<br>Manage USER: Employees <br /><br />
<ul class="linklist">
					
					<li><a href="employees.php">View Employees</a></li>
                    <li><a href="addnew.php">Add Employee</a></li>
                   <li><a href="search.php">Search Employee Directory</a></li>
					
				</ul> <br />';
			 
echo '<h2><small>REPORT MENU: </h2> </small><br /> <hr> <br />
<ul class="linklist">
					
					<li><a href="deduction.php"> Employees Deduction</a></li>
					<li><a href="report-maxhour-hourlyrate.php">Maximum Hours & Pay Rate of Hourly workers</a></li>
                    <li><a href="report-salary-employees.php">List of Employee recieving Annual Salary</a></li>
                   
					
				</ul> <br /> <br />';
			 } else { 
			 echo '<button class="btn btn-large btn-info" type="button"><i class="icon-cog icon-white"></i> </button><br /> <hr class="soften">
<div class="alert alert-error">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <h4><center>*****ACCESS DENIED*****</center></h4>
  <center>You don\'t have permission to view this page!</center>
</div>  <br />
<hr class="soften">';}
           
echo  '</div></div></div><hr class="soften">';			 
           		
include ('./inc/footer.php');
?>