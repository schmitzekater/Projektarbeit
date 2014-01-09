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
	session_start();
?>

<div id="content">s
<div class="pad2"></div>
<h2>Admin-Panel</h2>
<h3>L&auml;ufer &Uuml;bersicht</h3>			
	<?php
		
		$server = "i-intra-01";
		$user 	= "prog10";
		$passwd = "prog10";
		$dbase 	= "prog10";
		
		//Verbindung aufbauen
		$sql = mysql_connect($server, $user, $passwd);
		print("<DIV id='status'><u>Status</u><br>");
		if($sql)
			{print("Connection to $server ok <br>\n");}
		else
			{print("No Connection to $server ! <br>\n");}
		
		//Datenbank checken
		$db = mysql_select_db($dbase);
		if($db)
			{print("Datenbank $dbase ok <br>\n</div>");}
		else
			{
			print("Datenbankfehler: $dbase <br>\n");
			print("</div><DIV ID='content'><p>Leider konnte keine Verbindung zur Datenbank hergestellt werden</p></div>");
			}
			
	
		
		//DB-Abfrage
		$result = mysql_query("Select * from laeufer order by id");
		print("<table><tr><th>Startnummer</th><th>Name</th><th>Alter</th><th>Gewicht</th></tr>"); //Tabellenkopf
		while($row = mysql_fetch_assoc($result))
		{
		
			print("<tr><td>" .$row["ID"]."</td>");
			print("<td>" .$row["name"]."</td>");
			print("<td>" .$row["jahre"]."</td>");
			print("<td>" .$row["gewicht"]."</td>");
			print("</tr>");
		
		}
		print("</table>");
		//Verbindung schliessen
		mysql_close();
		?>

</body>
</html>