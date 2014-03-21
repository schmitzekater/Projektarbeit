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
<?php include "./php/nav.php"; ?>

<section id="content">
		  
<div id="main">


<?php
		require_once('./php/sitzungsstart.php');
		$seitentitel = 'Login';
		require_once('./php/zugang.php');
		
		
		$fehlermldg = "";
  
		if (!isset($_SESSION['id'])) {
			if (isset($_POST['submit'])) {

				$db = mysqli_connect("localhost", "dbuser", "dbuser", "genbank");
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
						setcookie('id', $zeile['id'], time() + (60 * 60 * 24 * 30));    // Verf������llt in 30 Tagen
						setcookie('nutzername', $zeile['nutzername'], time() + (60 * 60 * 24 * 30));  // Verf������llt in 30 Tagen
						$hauptseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
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
			
			require_once('./php/menu.php');

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




