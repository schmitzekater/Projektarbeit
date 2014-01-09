<html>	
<head>	
	<?php include'menu.php'?>
</head>
<body>
<div id="scroller">
<div id="content">
		<h1>Behandlung anlegen</h1>
		<form name = "beh_anlegen" method="get" action = "insert_treatment.php">
		<table cellspacing=5 cellpadding = 5 valign="top">
			<tr>
				<th colspan = "2">Untersuchung</th>
				<th colspan = "2">Befunde</th>
			<tr>
				<td>Tier-ID</td>
				<td><input type="text" length="20" name="TID"></td>
				<td>Labor abnehmen</td>
				<td><input type = "Checkbox" value = "1" name ="labor"></td>
			</tr>
			<tr>
				<td>Symptome</td>
				<td>
				<select name="Symptome" size="5" multiple >
						<option>Hinken</option>
						<option>Durchfall</option>
						<option>Appetitlosigkeit</option>
						<option>Erbrechen</option>
						<option>Blutungen</option>
						<option>Schl&auml;frigkeit</option>
						<option>Aggressivit&auml;t</option>
						<option>Blut im Stuhl</option>
						</td>
				<td>Bildgebung</td>
				<td><select name="Bildgebung" size="5" multiple >
						<option>R&ouml;ntgen</option>
						<option>MRT</option>
						<option>CT</option>
						<option>KM-CT</option>
						<option>Angiographie</option>
						<option>Sonographie</option></td>
			</tr>
			<tr>
				<td>Fieber</td>
				<td><input type="text" length="20" name="Fieber"></td>
				<td colspan=2></td>
			</tr>
			<tr>
				<td rowspan="2">Arztbericht</td>
				<td rowspan="2"><Textarea name = "Bericht" cols="30" rows="15" readonly>&lt;placeholder&gt;</textarea></td>
				<td>Impfungen</td>
				<td><textarea name="Impfungen" cols = "30" rows = "6" readonly>&lt;placeholder&gt;</textarea></td>
				
			</tr>
			<tr>
			<td>Sonstiges</td>
				<td><Textarea name = "Sonstiges" cols="30" rows="6" readonly>&lt;placeholder&gt;</textarea></td>
				
			</tr>
			<tr><td colspan="4"><HR></td></tr>
			<tr>
				<td><input type=reset value="L&ouml;schen"></td>
				<td><input type=submit value="Eintragen" ></td>
				<td colspan="2"></td>
			</tr>
		</table>
		</form>		
</div>
</div>
</body>
</html>