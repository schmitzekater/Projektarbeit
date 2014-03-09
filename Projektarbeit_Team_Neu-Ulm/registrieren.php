<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
<title>GenBank</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/main.css" />
	<link rel="stylesheet" type="text/css" href="./css/nav.css" />


</head>

<body>
<?php include "./php/nav.php"; ?>

<section id="content">
		  <article>
		  <p></p>
		  <p></p>
<h1>&nbsp;</h1>
<div id="main">
				<?php
	
		$seitentitel = 'Registrieren';
		require_once('includes/zugang.php');
	?>
	
<div id="wrapper">
	
	<?php
	
		require_once('includes/header.php');
		require_once('includes/menu.php');

		$db = mysqli_connect("localhost", "dbuser", "dbuser", "GenBank");
			mysqli_set_charset($db, "utf8");
  
		if (isset($_POST['submit'])) {

			$nutzername = mysqli_real_escape_string($db, trim($_POST['nutzername']));
			$email = mysqli_real_escape_string($db, trim($_POST['email']));
			$passwort = mysqli_real_escape_string($db, trim($_POST['passwort']));
			$passwortwdh = mysqli_real_escape_string($db, trim($_POST['passwortwdh']));

			if (!empty($nutzername) && !empty($email) && !empty($passwortwdh) && !empty($passwortwdh) && ($passwort == $passwortwdh)) {

				$sql = "SELECT * FROM nutzer WHERE nutzername = '$nutzername'";
				$daten = mysqli_query($db, $sql);
		
				if (mysqli_num_rows($daten) == 0) {
	  
					$code = rand(100000, 999999); 
					$code1 = rand(100000, 999999); 
				
					$sql = "INSERT INTO nutzer (nutzername, email, passwort, anmeldedatum, aktivierungscode, aktiviert, vergessen) VALUES ('$nutzername', '$email', SHA('$passwort'), NOW(), $code, 1, $code1)";
					mysqli_query($db, $sql);
        
					$absender = 'admin@neispiel.de';
					$betreff = "Beispiel - Aktivieren Sie Ihr Konto";
					$msg = "Hallo $nutzername,\n" .
					"Nur noch ein Schritt bis zu Ihrer Aktivierung ist nötig.\n" .
					"Besuchen sie http://beispiel.de/aktivierung.php und geben Sie Ihren Nutzernamen ( $nutzername ) und den Aktivierungscode ( $code ) ein.\n" .
					"Mit freundlichen Grüßen\n" .
					"Beispielseite";

					mail($email, $betreff, $msg, 'From:' . $absender);
		
					mysqli_close($db);
				
					echo '<p class="pass">Ihr Konto wurde erstellt. Sie k&ouml;nnen sich jetzt einloggen und die Seite ' .
					'<a href="memberarea.php">Memberarea</a> besuchen</p>';
					exit();
				}      
				else {
					echo '<p class="fail">Dieser Benutzername ist bereitsbelegt.</p>';
					$nutzername = "";
				}
			}
			else {
				echo '<p class="fail">Sie haben vergessen Daten einzugeben.</p>';
			}
		}
	?>
 
	<h2>Registrieren</h2>
	<p>W&auml;hlen Sie einen Benutzernamen und ein Passwort, um sich f&uuml;r Mutfinder zu registrieren.</p>

	<form method="post" action="registrieren.php">

		<label for="nutzername">Benutzername:</label>
		<input type="text" name="nutzername" />
	  
		<label for="email">E-Mail:</label>
		<input type="text" id="email" name="email" />
	   
		<label for="passwort1">Passwort:</label>
		<input type="password" name="passwort" />
	  
		<label for="passwort2">Passwort (Wiederholung):</label>
		<input type="password" name="passwortwdh" />
	  
		<input type="submit" value="Anmelden" name="submit" />
	
	</form>
  
	<?php require_once('includes/footer.php'); ?>

</div><!-- #wrapper -->

  </article>
  </section>

  <aside>
  
  
  <p>Ales aendert was</p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
			<H2>Information</H2>
			<p></p>
		  
			<p>Um die Funktionen dieser Seite nutzen zu können, ist ein Login notwendig. </p>
			<p><a href="login.php">Login </a></p>
			<p>Falls Sie noch nicht registriert sind, können Sie dies unter  <a href="registrieren.php">Registrieren </a> tun.</p>
			<p>Wir wünschen viel Freude mit dieser Webseite</p>
  

</aside>


<footer>		

<img class="DNABild" src="Bilder/dna-Strang.jpg" width="40" high="50">
<p>für weitere DNA-Info´s nutzen Sie bitte</p>

<p></p>
<p>----------------------------------------------------------------------------------------------------------------------------</p>
<p>fdasdsda</p>
<p>fdasdsda</p>
Copyright
</footer>
</div>
</body>
</html>
