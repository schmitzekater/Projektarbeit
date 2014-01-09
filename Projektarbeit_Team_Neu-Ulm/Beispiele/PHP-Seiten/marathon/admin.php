<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Homepage des Eselsberger Marathon e.V. </title>

<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php
	include ("navpane_admin.php");

?>


<div id="content">
<div class="pad2"></div>
<h2>Admin-Panel</h2>
<h3>Bitte loggen sie sich ein:</h3>
<table border = 0>
	<form name="login_form" method=GET action="admin_look.php">
		<tr>
			<td>Benutzername</td>
			<td><input type="text" name="login_name"></td>
		</tr>
		<tr>
			<td>Passwort</td>
			<td><input type="password" name ="login_pass"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Login" name="login_button"></td>
		</tr>
	</form>
</table>

</body>
</html>