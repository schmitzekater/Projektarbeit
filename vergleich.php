<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
<title>Genetikum - GenetikumDb - GenBank</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/main.css" />
	<link rel="stylesheet" type="text/css" href="./css/nav.css" />
	<link rel="stylesheet" type="text/css" href="./css/footer.css" />
	<link rel="stylesheet" type="text/css" href="./css/style-login.css" />
	<link rel="shortcut icon" href="Bilder/__favicon.ico">

</head>

<?php

	require_once('./php/sitzungsstart.php');
	$seitentitel = 'memberarea';
	require_once('./php/zugang.php');
		
	if(isset($_SESSION['nutzername'])) {
		$user = $_SESSION['nutzername'];

		$db = mysqli_connect("localhost","dbuser","dbuser","genbank");
			mysqli_set_charset($db, "utf8");

		$sql = "SELECT aktiviert, nutzername FROM nutzer WHERE nutzername = '$user' ";
		$daten = mysqli_query($db, $sql);
		$zeile = mysqli_fetch_array($daten);

		if ($zeile['aktiviert'] == 0) {

			$aktivierungsseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/aktivierung.php';
				header('Location:' . $aktivierungsseite);

			mysqli_close($db);

		}
	}
?>

<body>
<div id="container">
<?php include "./php/nav.php"; ?>

<section id="content">
		  <article>
		 
<div id="main">

			
			<p>Hallo Max...ich seh hier was...</p>
			 	
			<form action="vergleich.php" method="post">
 			<p>Geben Sie den Patientenindex ein, nach dem gesucht werden soll:</p>
 			<input type="text" name="Pat_idPat" /></p>
 			<p><input type="submit" /></p>
			</form>	
			
			
			
			<?php
			
 			 $idPat=(int)$_POST["Pat_idPat"];
 			echo '<p>Ich bins...</p>'.$idPat;
			// Neues Datenbank-Objekt erzeugen
			$db = @new mysqli( 'localhost', 'dbuser', 'dbuser', 'genbank' );
			// Pruefen ob die Datenbankverbindung hergestellt werden konnte
			if (mysqli_connect_errno() == 0)
					{
					 
   					 $sql = "SELECT mutp.Gene,mutp.HGVSnomenclature
							 from mutp,mutdat
							  where mutp.HGVSnomenclature=mutdat.nucleotide
							  and mutp.Pat_idPat=$idPat";
    				// Statement vorbereiten
   					$ergebnis = $db->prepare( $sql );
    				// an die DB schicken
   					 $ergebnis->execute();
    				// Ergebnis an Variablen binden
    				$ergebnis->bind_result( $Gene, $nomenclature );
    				// Ergebnisse ausgeben
   					 while ($ergebnis->fetch())
    					{
    					echo "Die Ver��nderung" .$nomenclature. " in dem Gen " .$Gene. "wurde in der Datenbank gefunden <br />";	
        				 
   						 }
							}
						else
						{
   							 // Es konnte keine Datenbankverbindung aufgebaut werden
   						 echo 'Die Datenbank konnte nicht erreicht werden. Folgender Fehler trat auf: <span class="hinweis">' .mysqli_connect_errno(). ' : ' .mysqli_connect_error(). '</span>';
							}
						// Datenbankverbindung schliessen
						$db->close();
 
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