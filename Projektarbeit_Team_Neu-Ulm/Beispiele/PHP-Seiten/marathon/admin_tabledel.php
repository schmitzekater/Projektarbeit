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
<h3>Alle L&auml;ufer l&ouml;schen</h3>
<h4>Willkommen <b><?php echo $_SESSION['name'] ; ?></b></h4>
<form name="form2" action="tabledel.php" method="GET">
	<table border = 0>
		<tr>
			<td>Warnung!!!</td>
			<td>Dieser Knopf l&ouml;scht die gesamte Tabelle!!</td>
		</tr>
		<tr>
			<td></td>
			<td>Wollen sie wirklich fortfahren??</td>
		</tr>
		<tr>
			<td><input type=submit value="Abbrechen" onclick="marathon.php"></td></td>
			<td align=right><input type=submit value="Fortfahren" ></td>
		</tr>
	</table>
</form>
</body>
</html>