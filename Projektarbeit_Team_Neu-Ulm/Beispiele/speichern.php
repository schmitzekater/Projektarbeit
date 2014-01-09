<html>
	<head>
		<title>SQL</title>
	</head>
	<?php
		$server="prog10";
		$datenbank="email";
		$user="prog10";
		$pass="prog10";
		
		$nachname = $_GET["Nachname"];
		$vorname = $_GET["Vorname"];
		$jahr = $_GET["Geburtsjahr"];
		$email = $_GET["Email"];
		
		$sql = mysql_connect("$server, $user,$pass");
		$db  = mysql_select_db($datenbank);
		
		$insert = mysql_query("insert into emailbesitzer values ('$nachname', '$vorname', $jahr, '$email')");
		$result = mysql_query("select Vorname, Nachname from Emailbesitzer WHERE Nachname like $nachname");
		
		print("<table><tr><td>$nachname, </td><td>$vorname hat folgende ggf. Verwandte</td></tr>");
		while($row = mysql_fetch_assoc($result))
		{
			print("<tr><td>$nachname, </td><td>".$row['Vorname']."</td></tr>");
		}
		print("</table>");
	?>
	<body>
	speichern
	</body>
</html>