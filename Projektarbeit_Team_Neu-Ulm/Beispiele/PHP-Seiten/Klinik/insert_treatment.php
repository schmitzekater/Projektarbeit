<html>	
<head>	
	<?php include'menu.php'?>
</head>
<body>
<div id="scroller">
<div id="content">
		
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
			
		//	letzte Startnummer wählen;
		// $erg = mysql_query("select MAX(TID) FROM Tiere");
		// $temp = mysql_fetch_assoc($erg);
		// $nummer = $temp["MAX(TID)"];
		$timestamp = time();
		$datum = date("Y-m-d",$timestamp);
		$tid = $_GET[TID];
		$labor = ($_Get[labor] =='1') ? 1 : 0;
		// $symptome = $_GET[Symptome];
		// $bildgebung = $_GET[Bildgebung];
		$fieber = $_GET[Fieber];
		// $bericht = $_GET[Bericht];
		// $impfungen = $_GET[Impfungen];
		// $sonstiges = $_GET[Sonstiges];
		mysql_query("insert into Untersuchung values($tid,'$datum',$fieber)");
	//	print("<br>Untersuchung erfolgreich angelegt.<br>TID: $tid<br>");
		print("<br>Box gesetzt? $labor");
		print("<ul><li><a href = 'behandlung_neu.php'>Weitere Untersuchung anlegen</a>
				<li><a href = 'index.php'>Zur Startseite</a>");
		mysql_close();
	?>
</div>
</div>
</body>
</html>