<?php
		$seitentitel = 'Login';
		require_once('includes/zugang.php');
  
		$fehlermldg = "";
  
		if (!isset($_SESSION['id'])) {
			if (isset($_POST['submit'])) {

				$db = mysqli_connect(DB_HOST, DB_BENUTZER, DB_PASSWORT, DB_NAME);
					mysqli_set_charset($db, "utf8");
      
				$nutzername = mysqli_real_escape_string($db, trim($_POST['nutzername']));
				$passwort = mysqli_real_escape_string($db, trim($_POST['passwort']));

				if (!empty($nutzername) && !empty($passwort)) {

					$sql = "SELECT id, nutzername FROM nutzer WHERE nutzername = '$nutzername' AND passwort = SHA('$passwort')";
					$daten = mysqli_query($db, $sql);
					$zeile = mysqli_fetch_array($daten);

					if (mysqli_num_rows($daten) == 1) {
					
						// Login erfolgreich, also die Cookies setzen und den Benutzer zur Hauptseite umleiten
						$_SESSION['id'] = $zeile['id'];
						$_SESSION['nutzername'] = $zeile['nutzername'];
						setcookie('id', $zeile['id'], time() + (60 * 60 * 24 * 30));    // Verfällt in 30 Tagen
						setcookie('nutzername', $zeile['nutzername'], time() + (60 * 60 * 24 * 30));  // Verfällt in 30 Tagen
						$hauptseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/memberarea.php';
							header('Location: ' . $hauptseite);
							
						mysqli_close($db);
					}
					else {
						$fehlermldg = 'Sie m&uuml;ssen g&uuml;ltige Zugangsdaten eingeben, um sich einzuloggen.';
					}
				}
				else {
					$fehlermldg = 'Sie m&uuml;ssen Ihre Zugangsdaten eingeben, um sich einzuloggen.';
				}
			}
		}
	?>
	
	<div id="wrapper">
	
		<?php
			require_once('includes/header.php');  
			require_once('includes/menu.php');

				if($fehlermldg != "") {
					echo '<p class="fail">' . $fehlermldg . '</p>';
				}
		?>

		<h2>Login</h2>
	
		<form method="post" action="login.php">
	
			<label for="nutzername">Benutzername:</label>
			<input type="text" name="nutzername" />
		
			<label for="passwort">Passwort:</label>
			<input type="password" name="passwort" />
		
			<input type="submit" value="Login" name="submit" />
		
		</form>

		<?php require_once('includes/footer.php'); ?>

	</div><!-- #wrapper -->