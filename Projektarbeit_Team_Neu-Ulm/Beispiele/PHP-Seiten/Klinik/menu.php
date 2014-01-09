
<title>Praxis Dr. Hasenfuss</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/mymenu.css">
<script src="script/click_hover.js" type="text/javascript"></script>
</head>
<body onload="clickMenu('menu')">
<img id="background" src="images/rabbit.jpg" alt="" title="" /> 
<?php
	$server="i-intra-01";
	$user="prog10";
	$password="prog10";
	$dbase="prog10";
?>
<div id="header">
	

	<h1><font color="white">Praxis Dr. Hasenfuss</h1>
	Virchowstr. 56 ¤ 89075 Ulm</font>
</div>
	<ul id="menu">
		<li class="sub">Home
			<ul>
				<li><a href = "index.php">Startseite</a></li>
			</ul>
		</li>
		<li class="sub">Besitzer
			<ul>
				<li><a href="besitzer_anlegen.php">Anlegen</a></li>
				<li><a href="besitzer_betrachten.php">Betrachten</a></li>
				<li><a href="#nogo">&Auml;ndern</a></li>
				<li><a href="#nogo">L&ouml;schen</a>
			</ul>
		</li>
		<li class="sub">Tiere
			<ul>
				<li><a href="tier_anlegen.php">Anlegen</a></li>
				<li><a href="tier_betrachten.php">Betrachten</a></li>
				<li><a href="#nogo">&Auml;ndern</a></li>
				<li><a href="#nogo">L&ouml;schen</a>
			</ul>
		</li>
		<li class="sub">Behandlungen
			<ul>
				<li><a href="behandlung_neu.php">Anlegen</a></li>
				<li><a href="behandlung_lesen.php">Betrachten</a></li>
			</ul>
		</li>
		<li class="sub">Kontakt
			<ul>
				<li><a href="impressum.php">Impressum</a></li>
				<li><a href="#nogo">Rufbereitschaft</a></li>
			</ul>
		</li>
	</ul>
<div id="fixed">
	<?php
	$timestamp = time();
	$tage = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag","Samstag");
	$datum = date("d.m.Y",$timestamp);
	$wochentag = date("w",$timestamp);
	$uhrzeit = date("H:i",$timestamp);
	echo $uhrzeit, "<br>",$tage[$wochentag],", ",$datum;
	?>
</div>

