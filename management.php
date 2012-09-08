<?php 

session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['empid'])) {
	require_once ('./inc/login_functions.inc.php');
	$url = absolute_url('login.php');
	header("Location: $url");
	exit();	
}
$page_title = 'ESSS| Management Menu'; $crumbs = "EMS"; $pageurl = "index.php"; $subCrumbs = "MANAGEMENT"; $subCrumbsurl ="management.php";
include ('inc/header.php');

if ($_SESSION['role']=="1")  {
			echo '<button class="btn btn-large btn-info" type="button"><i class="icon-cog icon-white"></i> </button><br /> <hr class="soften"> 
<ul class="linklist">
<li><a href="unitedway.php">View United Way Contribution</a></li>
<li><a href="add_united.php">Add United Way</a></li> </ul><br />';
 } else { 
echo '<button class="btn btn-large btn-info" type="button"><i class="icon-cog icon-white"></i> </button><br /> <hr class="soften">
<div class="alert alert-error">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <h4><center>*****ACCESS DENIED*****</center></h4>
  <center>You don\'t have permission to view this page!</center>
</div>  <br />
<hr class="soften">';}
           
echo '</div></div></div><hr class="soften">';			 

include ('./inc/footer.php');
?>