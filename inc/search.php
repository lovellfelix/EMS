 <h1>Directory Search</h1> <br />
 <p>Enter First Name and Last name</p> <hr /> <br />
<form action="search.php" method="post">
<p>First Name: <input type="text" name="fname" size="20" maxlength="80" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"  /> </p>
	<p>Last Name: <input type="text" name="lname" size="20" maxlength="80"value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"  /></p>
	 <p><input type="submit" name="submit" value="Find Now!" /></a></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>