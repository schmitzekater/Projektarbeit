<html>	
<head>	
	<?php include'menu.php'?>
</head>
<body>

	<?php
	print("<div id='scroller'><div id='content'>");
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
			
		$nachname = $_GET[Nachname];
		$id = $_GET[ID];
		
		IF(empty($nachname)||!isset($nachname)) //Hier eventuell später noch anpassen!!!!!!
		{
			IF(empty($id)||!isset($id))
			{
				$result = mysql_query("select * from Besitzer order by 1"); 	//falls keine id suche nach allen
			}
			else
			{	
				$result = mysql_query("select * from Besitzer where BID = $id order by 1");	}
		}
		else
		{
			$result = mysql_query("select * from Besitzer where Nachname like '".$nachname."%' order by 2;");
		}
		
		print("<table cellpadding ='5' cellspacing ='5'><tr><th>Bid</th><th>Nachname</th><th>Vorname</th><th>Registrierte Tiere</th></tr>"); //Tabellenkopf
		while($row = mysql_fetch_assoc($result))
		{
			$id = $row["BID"];
			$tiere = mysql_query("select count(TID) from Tiere where BID = $id;");
			$tierzahl = mysql_fetch_array($tiere, MYSQL_NUM);
			$anzahl = $tierzahl[0];
			print("<tr><td>" .$row["BID"]."</td>");
			print("<td>" .$row["Nachname"]."</td>");
			print("<td>" .$row["Vorname"]."</td>");
			IF($anzahl>0)
			{
			print("<td>$anzahl</td>");
			}
			ELSE 
			{
			print("<td></td>");
			}
			print("</tr>");
		
		}
		print("</table></div></div>");
	//Verbindung schliessen
		mysql_close();
	?>
	
</body>
</html>