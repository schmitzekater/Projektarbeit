<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
<title>GenBank</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/main.css" />
	<link rel="stylesheet" type="text/css" href="./css/nav.css" />
	<link rel="stylesheet" type="text/css" href="./css/footer.css" />
	<link rel="stylesheet" type="text/css" href="./css/style-login.css" />


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
	
		<?php

		$seitentitel = 'Passwort vergessen';
		require_once('./php/zugang.php');
	?>
	
<div id="wrapper">

	<?php
        
		if (isset($_POST['submit'])) {
			// Mit der Datenbank verbinden
			$db = mysqli_connect("localhost", "dbuser", "dbuser", "genbank");
			mysqli_set_charset($db, "utf8");
      
			// Die eingegebenen Login-Daten abrufen
			$nutzername = mysqli_real_escape_string($db, trim($_POST['nutzername']));
			$email = mysqli_real_escape_string($db, trim($_POST['email']));

			if (!empty($nutzername) && !empty($email)) {
				// Benutzername und Passwort in der Tabelle nachschlagen
				$sql = "SELECT email, nutzername FROM nutzer WHERE nutzername = '$nutzername' AND email = '$email'";
				$daten = mysqli_query($db, $sql);
				$zeile = mysqli_fetch_array($daten);

				if (mysqli_num_rows($daten) == 1) {
				// Abfrage erfolgreich, also Daten an E-Mail senden und Sicherheitscode in die Datenbankspeichern inkl. Code generieren.
					$vergessencode = rand(100000, 999999);
		
					mysqli_query($db, "UPDATE nutzer SET vergessen = '$vergessencode' WHERE nutzername = '$nutzername'")
						or die(mysqli_error());
		 
					$absender = 'admin@Projekt.de';
					$betreff = "Beispiel - Haben Sie Ihr Passwort vergessen?";
					$msg = "Hallo $nutzername,\n" .
					"wenn Sie ihr Passwort vergessen haben besuchen Sie bitte http://localhost/zuruecksetzen.php und &auml;ndern Sie ihr vergessenes Passwort in ein neues gew&uuml;nschtes Passwort um.\n" .
					"Dazu ben&ouml;tigen Sie nur Ihren Benutzernamen ( $nutzername ) und einen generierten Sicherheitsschl$uuml;ssel ( $vergessencode ). \n" .
					"Falls Sie Ihr Passwort nicht vergessen haben ignorieren Sie diese E-Mail bitte einfach. \n" .
					"Mit freundlichen Gr&uuml;&szlig;en\n" .
					"Ihr Projektteam Neu-Ulm";

					mail($email, $betreff, $msg, 'From:' . $absender);
		
					echo '<p class="pass">Sie haben einen entsprechenden Sicherheitscode an Ihre E-Mail Adresse erhalten. Sie k&ouml;nnen <a href="zuruecksetzen.php">hier</a> Ihr Passwort zur&uuml;cksetzen.</p>';
					
					mysqli_close($db);
				}
				else {
					echo '<p class="fail">E-Mail und Nutzername stimmen nicht &uuml;berein.</p>';
				}
			}
			else {
				echo '<p class="fail">Sie haben vergessen Daten einzugeben.</p>';
			}
		}
	?>
	
	<h2>Passwort&auml;nderung anfordern</h2>

	<form method="post" action="vergessen.php">

		<label for="nutzername">Benutzername:</label>
		<input type="text" id="nutzername" name="nutzername"/>
	
		<label for="email">E-Mail:</label>
		<input type="text" id="email" name="email" />
	
		<input type="submit" value="Anfordern" name="submit" />
	
	</form>
 
</div><!-- #wrapper -->

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



