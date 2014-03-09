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
		require_once('includes/sitzungsstart.php');
        $seitentitel = 'Profil bearbeiten';
		require_once('includes/zugang.php');  
  
    ?>
	
<div id="wrapper">
	
	<?php
	
		require_once('includes/header.php');  
		require_once('includes/menu.php');
				
		if (!isset($_SESSION['id'])) {
			echo '<p class="fail">Um auf diese Seite zugreifen zu k&ouml;nnen, m&uuml;ssen Sie sich <a href="login.php">einloggen</a>.</p>';
			exit();
		}
		
		if (isset($_POST['submit'])) {
 
			$db = mysqli_connect("localhost", "dbuser", "dbuser", "GenBank");
				mysqli_set_charset($db, "utf8");
  
			$passwort = mysqli_real_escape_string($db, trim($_POST['password']));
			$newpw = mysqli_real_escape_string($db, trim($_POST['newpw']));
			$wdhnewpw = mysqli_real_escape_string($db, trim($_POST['wdhnewpw']));
			$nutzername = $_SESSION['nutzername'];
  
			if(!empty($passwort) && !empty($newpw) && !empty($wdhnewpw)) { 

				$sql = "SELECT nutzername, passwort FROM nutzer WHERE nutzername = '$nutzername' AND passwort = SHA('$passwort')";
   
				$daten = mysqli_query($db, $sql);
   
				if (mysqli_num_rows($daten) == 1) {
					if ($newpw == $wdhnewpw) {
					
						mysqli_query($db, "UPDATE nutzer SET passwort = SHA('$newpw') WHERE nutzername = '$nutzername'")
							or die(mysqli_error());
							
						mysqli_close($db);
		 
						echo '<p class="pass">Ihr Passwort wurde erfolgreich ge�ndert.</p>';
		 
					}
					else {
						echo '<p class="fail">Die beiden neuen Passw�rter stimmen nicht �berein.</p>';
					}
                }
				else {
					echo '<p class="fail">Ihr aktuelles Passwort simmt nicht.</p>';
				}
			}
			else {
				echo '<p class="fail">Sie haben die ben�tigten Felder nicht ausgef�llt.</p>';
			}  
		}  
	?>

	<form method="post" action="profiledit.php">
 
		<label for="nutzername">Aktuelles Passwort:</label>
		<input type="password" id="password" name="password"/>
	  
		<label for="newpw">Neues Passwort:</label>
		<input type="password" id="newpw" name="newpw" />
	  
		<label for="wdhnewpw">Wiederholung neues Passwort:</label>
		<input type="password" id="wdhnewpw" name="wdhnewpw" />
	  
		<input type="submit" value="Aktivieren" name="submit" />
	
	</form>
  
	<?php require_once('includes/footer.php'); ?>
  
</div> <!-- #wrapper -->
  </article>
  </section>

  <aside>
  
  
  <p></p>
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



