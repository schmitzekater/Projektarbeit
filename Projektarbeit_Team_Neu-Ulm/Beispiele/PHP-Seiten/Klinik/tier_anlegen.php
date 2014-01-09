<html>	
<head>	
	<?php include'menu.php'?>
</head>
<body>
<div id="scroller">
<div id="content">
		<h1>Neues Tier anlegen</h1>
		<table border = 0>
			<form name="Tier_anlegen" action="insert_ani.php" method="GET">
				<tr>
					<td>Name</td>
					<td><input type="text" name="Name" length="20"></td>
				</tr>
				<tr>
					<td>Tierart</td>
					<td>
						<select name="Tierart" size="1">
						<option>Hund</option>
						<option>Katze</option>
						<option>Vogel</option>
						<option>Kleinvieh</option>
						<option>Nagetier</option>
						<option>Reptil</option>
						<option>Gro&szlig;vieh</option>
					</td>
				</tr>
				<tr>
					<td>Rasse</td>
					<td><input type="text" name="Rasse" length="10"></td>
				</tr>
				<tr>
					<td>Farbe</td>
					<td><input type="text" name="Farbe" length="20"></td>
				</tr>
				<tr>
					<td>Besitzer-ID</td>
					<td><input type="text" name="Besitzer" length="20"></td>
				</tr>
				<tr>
					<td></td>
					<td align=right><input type=submit value="Eintragen" ></td>
				</tr>
			</Form>
		</table>
</div>
</div>
</body>
</html>