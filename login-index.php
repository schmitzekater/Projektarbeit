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

<body>
<div id="container">
<?php include "./php/nav.php"; ?>

<section id="content">
		
<div id="main">



<?php

		require_once('./php/sitzungsstart.php');
		require_once('./php/zugang.php');
		$seitentitel = 'Loginsystem';

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
	
	<div id="wrapper">
		
		<h2>Login</h2>

		<form method="post" action="login.php">
		
			<label for="nutzername">Benutzername:</label>
			<input type="text" id="nutzername" name="nutzername" />
			
			<label for="passwort">Passwort:</label>
			<input type="password" id="passwort" name="passwort" />
			
			<input type="submit" value="Login" name="submit" />
			
		</form>
  
		<!-- Registrieren Form -->
  
		<h2>Registrieren</h2>
  
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
	