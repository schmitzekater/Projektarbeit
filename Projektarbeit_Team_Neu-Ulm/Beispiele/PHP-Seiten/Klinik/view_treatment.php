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
			
		$name = $_GET[Name];
		$id = $_GET[ID];
		
		IF(empty($nachname)||!isset($nachname)) //Hier eventuell später noch anpassen!!!!!!
		{
			IF(empty($id)||!isset($id))
			{
				$result = mysql_query("select * from Untersuchung order by 1"); 	//falls keine id suche nach allen
			}
			else
			{	
				$result = mysql_query("select * from Untersuchung where TID = $id order by 1");	}
		}
		// else
		// {
			// $result = mysql_query("select * from Untersuchung where Name like '".$name."%' order by 2;");
		// }
		print("<table cellpadding ='5' cellspacing ='5'>
			<tr>
				<th>Tid</th>
				<th>Tiername</th>
				<th>Untersuchungs-Datum</th>
				<th>Fieber</th>
				<th>Besitzer</th>
			</tr>"); //Tabellenkopf
		while($row = mysql_fetch_assoc($result))
		{
		
			$tid = $row["TID"];
			$tier = mysql_query("select * from Tiere where TID = $tid");
			$tierrow = mysql_fetch_array($tier);
			$tiername = $tierrow['name'];
			$bid = $tierrow['BID'];
			$date = $row["Datum"];
			$fieber = $row["Fieber"];
			print("<tr><td>$tid</td>");
			print("<td>$tiername</td>");
			print("<td>$date</td>");
			print("<td>$fieber</td>");
			// print("<td>" .$row["Farbe"]."</td>");
			/*Unterabfrage über den Besitzer */
			$owner = mysql_query("select * from Besitzer where BID = $bid");
			$ownerrow = mysql_fetch_array($owner);
			$nachname = $ownerrow['Nachname'];
			$vorname = $ownerrow['Vorname'];
		//	print("<td>$bid</td>");
			print("<td>$nachname, $vorname</td>");
			print("</tr>");
		
		}
		print("</table></div></div>");
	//Verbindung schliessen
		mysql_close();
	?>
	
</body>
</html>