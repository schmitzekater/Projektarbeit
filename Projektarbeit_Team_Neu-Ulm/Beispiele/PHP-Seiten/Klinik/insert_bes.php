<html>	
<head>	
	<?php include'menu.php'?>
	<!<meta http-equiv="refresh" content="3;url=index.php">
</head>
<body>

	<?php
	print("<div id='scroller'><div id='content',>");
		$sql = mysql_connect($server, $user, $password);
		print("<u>Status</u><br>");
		if($sql)
			{print("Connection to $server ok <br>\n");}
		else
			{print("No Connection to $server ! <br>\n");}
		
		//Datenbank checken
		$db = mysql_select_db($dbase);
		if($db)
			{print("Datenbank $dbase ok <br>\n");}
		else
			{print("Datenbankfehler: $dbase <br>\n");}
			
			//letzte Startnummer wählen;
		$erg = mysql_query("select MAX(BID) FROM Besitzer");
		$temp = mysql_fetch_assoc($erg);
		$nummer = $temp["MAX(BID)"];
		
		IF(empty($nummer)||!isset($nummer)) 
			{
			$nummer=1;			//falls kein Besitzer vorhanden auf 1 setzen.
			}
			else
			{
			++$nummer;//nächste Nummer zuweisen.
			}
		$nachname = $_GET[Nachname];
		$vorname = $_GET[Vorname];
		
		mysql_query("insert into Besitzer values($nummer,'$nachname','$vorname')");
		print("<br>Benutzer erfolgreich angelegt.<br>BID: $nummer<br>");
		print("<ul><li><a href = 'besitzer_anlegen.php'>Weiteren Besitzer anlegen</a>
				<li><a href = 'tier_anlegen.php'>Tier anlegen</a>
				<li><a href = 'index.php'>Zur Startseite</a>");
		mysql_close();
	?>
	
</body>
</html>