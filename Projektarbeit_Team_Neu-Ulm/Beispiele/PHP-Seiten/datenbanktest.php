<html>	
<head>
<title>Connect to Schmitze!</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
		<?php include "nav.php"; ?>
		<div id="container">
			<h1>Schmitze's Datenbanken!</h1>
			<h4>Dienstag, 14.12.2010</h4>
		<div class="columnone">
			
			
	<?php
		
		$server = "i-intra-01";
		$user 	= "prog10";
		$passwd = "prog10";
		$dbase 	= "prog10";
		
		//Verbindung aufbauen
		$sql = mysql_connect($server, $user, $passwd);
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
			
		//Test Teil Tabelle erzeugen
		//mysql_query("create table laeufer (nummer int, nachname char(20), jahre int, gewicht int)");
		
		$nachname = "barney";
		$alter = 41;
		$gewicht= 90;
		
		mysql_query("insert into laeufer values(3,'$nachname',$alter,$gewicht)");
		
		//DB-Abrage
		$result = mysql_query("Select * from laeufer");
		while($row = mysql_fetch_assoc($result))
		{
			print("Nr." .$row["nummer"]);
			print(", " .$row["nachname"]);
			print(", Alter  " .$row["jahre"]);
			print(", Gewicht " .$row["gewicht"]);
			print("<br>");
		}
		//Verbindung schliessen
		mysql_close();
		?>
		</div>
		</div>
	</body>
</html>
			