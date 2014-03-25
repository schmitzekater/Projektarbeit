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
					<h1>Suche nach &Uuml;bereinstimmungen</h1>
					<input type="button" id="toggle" value="Hinweis ausblenden" onClick="toggleElement('#hinweis')" />
					<div id="hinweis">
							<p>Bitte beachten:</p>
							<p>Der Patient muss vorher als csv Datei hochgeladen worden sein.
								Der Patientenname entspricht dann dem Dateinamen ohne
								Erweiterung.</p>
							<p>Als Beispiel: Patient1.csv</p>
							<p>Der Patientenname wäre dann Patient1.</p>
						</div>
					<form action="vergleich.php" method="post">
						<p>Geben Sie nun den Patientennamen ein, nach dem gesucht werden
							soll:</p>
						<input type="text" name="PName" />
						<p>
							<input type="submit" />
						</p>
					</form>
			
			
			
			<?php
			if (! isset ( $_POST ["PName"] )) {
			} else {
				$Name = $_POST ["PName"];
				// Neues Datenbank-Objekt erzeugen
				$db = @new mysqli ( 'localhost', 'dbuser', 'dbuser', 'genbank' );
				// Pruefen ob die Datenbankverbindung hergestellt werden konnte
				if (mysqli_connect_errno () == 0) {
					
					$sql = "SELECT mutp.Gene,mutp.HGVSnomenclature
							 from mutp,mutdat,genname,pat
							  where mutp.HGVSnomenclature=mutdat.nucleotide
                              and mutp.Gene=genname.name
							  and pat.Name=('$Name')";
					
					// Statement vorbereiten
					$ergebnis = $db->prepare ( $sql );
					// an die DB schicken
					$ergebnis->execute ();
					$ergebnis->store_result ();
					$num_of_rows = $ergebnis->num_rows;
					// Ergebnis an Variablen binden
					$ergebnis->bind_result ( $Gene, $nomenclature );
					// Ergebnisse ausgeben
					if ($num_of_rows > 0) {
						while ( $ergebnis->fetch () ) {
							echo " Die Ver&auml;nderung <b>" . $nomenclature . "</b> in dem Gen <em>" . $Gene . "</em> wurde in der Datenbank gefunden <br />";
						}
					} else {
						// Es konnte keine Datenbankverbindung aufgebaut werden
						echo 'Keine &Uuml;bereinstimmung gefunden.';
					}
				} else {
					echo 'Die Datenbank konnte nicht erreicht werden. Folgender Fehler trat auf: <span class="hinweis">' . mysqli_connect_errno () . ' : ' . mysqli_connect_error () . '</span>';
					// Datenbankverbindung schliessen
				}
				$db->close ();
			}
			
			?>
			
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