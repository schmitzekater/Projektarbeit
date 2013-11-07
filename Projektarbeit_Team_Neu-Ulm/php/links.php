<aside>
	<!-- Hier könnte ihr Menu stehen -->
	<h1>Linksmenu</h1>
	<ul>
		<li><a href="index.php">Start</a></li>
		<li><a href="upload.php">Upload</a></li>
		<li><a href="browse.php">Durchsuchen</a></li>
		<li><a href="admin.php">Administration</a></li>
		<li></li>
		<li></li>
		<li><a href="login.php">Login</a>
	</ul>
	<div id="time">
	<?php
	$timestamp = time();
	$tage = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag","Samstag");
	$datum = date("d.m.Y",$timestamp);
	$wochentag = date("w",$timestamp);
	$uhrzeit = date("H:i",$timestamp);
	echo $uhrzeit, "<br>",$tage[$wochentag],", ",$datum;
	?>
</div>
</aside>
