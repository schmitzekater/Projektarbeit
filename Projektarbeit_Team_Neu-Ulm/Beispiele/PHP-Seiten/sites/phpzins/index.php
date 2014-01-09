<html>
	<head>
		<title>Mein php-Zinsrechner</title>
	</head>
	<body>
		<table border=1>
			<tr>
				<td>Guckst du hier meine vermaledeiten Zinszahlen!!!!</td>
				<td>ding....</td>
			</tr>
			<?php 
				$kap = 5000;
			    $zins = 3.4;
				$jahre = 15;
				$i=1;
			for ($i=1;$i<=$jahre;$i+=1)
			{
				$kap = round($kap*(1+$zins/100),2);
				print("<tr><td align=right>Jahr $i&nbsp;</td><td>  $kap</td></tr>");
			}
		?>
			
		</table>
		<a href="http://prog.informatik.hs-ulm.de/10/">Zurück zur Übersicht</a>
		
	</body>
</html>