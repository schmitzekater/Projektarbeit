<html>	
<head>	
	<?php include'menu.php'?>
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
		$erg = mysql_query("select MAX(TID) FROM Tiere");
		$temp = mysql_fetch_assoc($erg);
		$nummer = $temp["MAX(TID)"];
		
		IF(empty($nummer)||!isset($nummer)) 
			{
			$nummer=1;			//falls kein Tier vorhanden auf 1 setzen.
			}
			else
			{
			++$nummer;//nächste Nummer zuweisen.
			}
		$name = $_GET[Name];
		$tierart = $_GET[Tierart];
		$rasse = $_GET[Rasse];
		$farbe = $_GET[Farbe];
		$bid = $_GET[Besitzer];
		
		mysql_query("insert into Tiere values($nummer,'$name','$tierart','$rasse','$farbe',$bid)");
		print("<br>Tier erfolgreich angelegt.<br>TID: $nummer<br>");
		print("<ul><li><a href = 'tier_anlegen.php'>Weiteres Tier anlegen</a>
				<li><a href = 'besitzer_anlegen.php'>Besitzer anlegen</a>
				<li><a href = 'index.php'>Zur Startseite</a>");
		mysql_close();
	?>
	
</body>
</html>