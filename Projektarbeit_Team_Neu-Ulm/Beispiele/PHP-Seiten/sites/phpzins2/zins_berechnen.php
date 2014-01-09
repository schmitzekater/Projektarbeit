<html>
<head>
	<title>Zinsberechnung der Schmitz-Bank GmbH & Co. Kg Cie. Holding Intl.</title>
	<link rel="stylesheet" type="text/css" href="meincss.css">
	<style type ="text/css">
	table.mytable {border:2px; border-style:dotted;}
	td.mytd {border-style:dotted;}
	</style>

</head>
<body bgcolor="#ffFF99">
	<table border =0>
		<tr valign=bottom>
			<td><img src="..\..\images\euro.gif" width=100 height=100></img></td>
			<td colspan="7"><h1>Schmitz-Bank</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td bgcolor="#ff9900"><a href="index.html">Startseite</a></td>
			<td bgcolor="#ff9900"><a href="zins.html">Zinsrechner</a></td>
			<td bgcolor="#ff9900"><a href="privat.html">Privatkunden</a></td>
			<td bgcolor="#ff9900"><a href="kontakt.html">Kontakt</a></td>
			<td bgcolor="#ff9900"><a href="login.php">Meine Schmitz-Bank</a></td>
			<td bgcolor="#ff9900"><a href="impressum.html">Impressum</a></td>
			<td bgcolor="#ff9900"><a href="help.html">Help</a></td>
		</tr>
		<tr>
		
		
		</tr>
		<tr>
			<td valign=top><h2>Zinsrechner</td>
			<td colspan=7>
				<table border="1" bgcolor="#FFFFFF" class="mytable">
						<?php
							$jahre	 = $_GET["jahre"];
							$kapital = $_GET["kap"];
							$zins 	 = $_GET["zins"];
							$i=0;
							print("<tr><td colspan=2 bgcolor=#ffa500><em>Zinsrechner</em> für $jahre Jahre. Kapital: $kapital &euro;  Zinssatz: $zins &#37;</td></tr>");
							for ($i=1;$i<=$jahre;$i+=1)
							{
								$kapital = round($kapital*(1+$zins/100),2);
								print("<tr><td align=right>Jahr $i&nbsp;</td><td>  $kapital</td></tr>");
							}
						?>
				</table>
			</td>
		</tr>
	</table>
</body>
<a href="http://prog.informatik.hs-ulm.de/10/"><font color="black">Projekt-Index</font></a>
</html>