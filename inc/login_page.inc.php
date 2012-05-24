<?php # Script 11.1 - login_page.inc.php

// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include the header:
$page_title = 'ESSS| Login';
include ('./inc/header.html');

// Print any error messages, if they exist:
if (!empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

// Display the form:
?>
<h2>Login</h2>
<br />
<hr >
<br />
<!--<p><font color="#FF0000"size="3">Security feature on site Removed! All pages can be viewed</font> <br /></P>-->
<p>Enter your Username and Password </p>
<br />
<form action="login.php" method="post">
	<p>UserName: <input type="text"  align="left"name="username" size="20" maxlength="80" /> </p>
	<p>Password: <input type="password"  align="left" name="password" size="20" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Login" /> </p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
 <hr  />
 <p><b> <font color= color="#FF0000">DEMO Username and Password <br /> <br/>
 *Regular User <br />Username: bill.right <br />password: pa$$word <br  /> <br />
 *Manager <br />Username: jonas.hope <br />password: $kynet<br  /> <br /> </b>
<?php // Include the footer:

include ('./inc/footer.html');
?>
