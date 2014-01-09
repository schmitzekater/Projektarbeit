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
<h3>L&auml;ufer l&ouml;schen</h3>
<h4>Willkommen <b><?php echo $_SESSION['name'] ; ?></b></h4>
<form name="form2" action="delete.php" method="GET">
	<table border = 0>
		<tr>
			<td>Startnummer</td>
			<td><input type="text" name="nummer"></td>
		</tr>
		<tr>
			<td>Name</td>
			<td><input type="text" name="name"></td>
		</tr>
		<tr>
			<td>Alter</td>
			<td><input type="text" name="jahre"></td>
		</tr>
		<tr>
			<td>Gewicht</td>
			<td><input type="text" name="gewicht"></td>
		</tr>
		<tr>
			<td></td>
			<td align=right><input type=submit value="L&ouml;schen" ></td>
		</tr>
	</table>
</form>
</body>
</html>