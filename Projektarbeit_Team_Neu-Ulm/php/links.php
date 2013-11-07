<aside>
	<!-- Hier könnte ihr Menu stehen -->
	<h1>Linksmenu</h1>
	<ul>
		<li>Punkt 1</li>
		<li>Punkt 2</li>
		<li>Punkt 3</li>
		<li>Punkt 12</li>
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
