<html>	
<head>	
	<script type ="text/javascript">
	function checkEingabe()
	{
		var nachname = document.besitzer_anlegen.Nachname.value;
		var vorname  = document.besitzer_anlegen.Vorname.value;
		alert('variablen!!!! nachname, vorname';
		if(nachname == '' || vorname = '') return false;
		return true;
	}
	</script>
	<?php include'menu.php'?>
	
<!--</head>
<body> -->
<div id="scroller">
<div id="content">
		<h1>Neuen Besitzer anlegen</h1>
		<table border = 0>
			<form name="Besitzer_anlegen" action="insert_bes.php" method="GET" onSubmit = "return checkEingabe();">
				<tr>
					<td>Nachname</td>
					<td><input type="text" name="Nachname" length="20"></td>
				</tr>
				<tr>
					<td>Vorname</td>
					<td><input type="text" name="Vorname" length="20"></td>
				</tr>
				<tr>
					<td>Geburtsdatum</td>
					<td><input type="text" name="Geb_Datum" length="10" value="&lt;placeholder&gt;" readonly></td>
				</tr>
				<tr>
					<td>Strasse</td>
					<td><input type="text" name="Strasse" length="20" value="&lt;placeholder&gt;" readonly></td>
				</tr>
				<tr>
					<td>Ort</td>
					<td><input type="text" name="Ort" length="20" value="&lt;placeholder&gt;" readonly></td>
				</tr>
				<tr>
					<td>Telefon</td>
					<td><input type="text" name="Telefon" length="14" value="&lt;placeholder&gt;" readonly></td>
				</tr>
				<tr>
					<td>Mobil</td>
					<td><input type="text" name="Mobil" length="14" value="&lt;placeholder&gt;" readonly></td>
				</tr>
				<tr>
					<td>Email-Adresse</td>
					<td><input type="text" name="email" length="40" value="&lt;placeholder&gt;" readonly></td>
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