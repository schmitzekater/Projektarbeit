<?php

		require_once('./php/sitzungsstart.php');
		require_once('./php/zugang.php');
		$seitentitel = 'Loginsystem';

		if(isset($_SESSION['nutzername'])) {
		
			$user = $_SESSION['nutzername'];
			$db = mysqli_connect("localhost", "dbuser", "dbuser", "GenBank");
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
	
		<?php
			require_once('./php/header.php');  
			require_once('./php/menu.php');
		?>

   <!-- ==================
     	=======Login======
		================== -->
		
		<h2>Login</h2>

		<form method="post" action="./Admin/login.php">
		
			<label for="nutzername">Benutzername:</label>
			<input type="text" id="nutzername" name="nutzername" />
			
			<label for="passwort">Passwort:</label>
			<input type="password" id="passwort" name="passwort" />
			
			<input type="submit" value="Login" name="submit" />
			
		</form>
  
		<!-- Registrieren Form -->
  
		<h2>Registrieren</h2>
  
	<form method="post" action="./Admin/registrieren.php">

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
  
		<?php require_once('./php/footer.php'); ?>

	</div><!-- #wrapper -->