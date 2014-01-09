<html>	
<head>	
	<?php include'menu.php'?>
</head>
<body>
<div id="scroller">
<div id="content">
		<h1>Besitzer betrachten</h1>
		<p>Suchen über folgenden Parameter</p>
		<table>
		<form name="ansehen_form" method="GET" action="view_bes.php">
			<tr>
				<td>Nachname</td>
				<td><input type ="text" length ="20" name="Nachname"></td>
			</tr>
			<tr>
				<td>Benutzer-ID</td>
				<td><input type ="text" length ="20" name="ID"></td>
			</tr>
			<tr>
				<td></td>
				<td align=right><input type ="submit" value="Suchen"></td>
			</tr>
		</table>
</div>
</div>
</body>
</html>