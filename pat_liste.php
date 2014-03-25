<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8" />
<title>Genetikum - GenetikumDb - GenBank</title>
<link rel="stylesheet" type="text/css" href="./css/main.css" />
<link rel="stylesheet" type="text/css" href="./css/nav.css" />
<link rel="stylesheet" type="text/css" href="./css/footer.css" />
<link rel="stylesheet" type="text/css" href="./css/style-login.css" />
<link rel="shortcut icon" href="Bilder/__favicon.ico">
<!-- jQuery and jQuery UI -->
<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/getPatients.js"></script>


</head>

<?php
require_once ('./php/sitzungsstart.php');
$seitentitel = 'memberarea';
require_once ('./php/zugang.php');

if (isset ( $_SESSION ['nutzername'] )) {
	$user = $_SESSION ['nutzername'];
	
	$db = mysqli_connect ( "localhost", "dbuser", "dbuser", "genbank" );
	mysqli_set_charset ( $db, "utf8" );
	
	$sql = "SELECT aktiviert, nutzername FROM nutzer WHERE nutzername = '$user' ";
	$daten = mysqli_query ( $db, $sql );
	$zeile = mysqli_fetch_array ( $daten );
	
	if ($zeile ['aktiviert'] == 0) {
		
		$aktivierungsseite = 'http://' . $_SERVER ['HTTP_HOST'] . dirname ( $_SERVER ['PHP_SELF'] ) . '/aktivierung.php';
		header ( 'Location:' . $aktivierungsseite );
		
		mysqli_close ( $db );
	}
}
?>

<body>
	<div id="container">
<?php include "./php/nav.php"; ?>

<section id="content">
			<article>

				<div id="main">
					<hr />
					<span id="inputWrapper"> Zeilen anzeigen:
					<input type="text"	id="rows" cols="2" />
					<!--TODO: Hidden input field einbauen, dass die "ab" Zeile-Funktionalität hat. -->
					<br />
					<!-- <input type="button" id="nextRows" value="Next"	onClick="getNextData()" /> -->
					</span>
					<input type="button" id="clickMe" value="Daten laden"	onClick="getData()" />
					<input type="button" id="toggle" value="Tabelle ausblenden" onClick="toggleElement('#output')" />

					<div id="output">Bereit zur Abfrage.</div>

				</div>

			</article>
		</section>

		<aside>
<?php include "./php/aside.php"; ?>
</aside>


		<footer>


<?php include "./php/footer_Seite.php"; ?>

</footer>
	</div>
</body>
</html>