<?php
		$seitentitel = 'Aktivieren';
		require_once('includes/zugang.php');
?>
	
<div id="wrapper">
	
	<?php
		require_once('includes/header.php');
		require_once('includes/menu.php');

		// Mit Datenbank verbinden
		$db = mysqli_connect(DB_HOST, DB_BENUTZER, DB_PASSWORT, DB_NAME);
			mysqli_set_charset($db, "utf8");

			if (isset($_POST['submit'])) {

				$nutzername = mysqli_real_escape_string($db, trim($_POST['nutzername']));
				$code = mysqli_real_escape_string($db, trim($_POST['aktivierung']));

				if(!empty($nutzername) && !empty($code)) {
  
					$sql = "SELECT * FROM nutzer WHERE nutzername = '$nutzername' AND aktivierungscode = '$code'";
					$daten = mysqli_query($db, $sql);
					$zeile = mysqli_fetch_array($daten);
   
					if (mysqli_num_rows($daten) == 1) {
					
						echo '<p class="pass">Ihr Account wurde erfolgreich aktiviert. <a href="memberarea.php">Memberarea</a></p>';
		 
						mysqli_query($db, "UPDATE nutzer SET aktiviert = '1' WHERE nutzername = '$nutzername'")
							or die(mysqli_error());
						
						mysqli_close($db);
					}
					else {
						'<p class="fail">Die angegebenen Daten sind leider falsch.</p>';
					}

				}  
				else {
					echo '<p class="fail">Sie haben vergessen Daten einzugeben.</p>';
				} 
			}
	?>

	<h2>Account aktivieren</h2>

	<p>Sie m&uuml;ssen ihren Account noch aktivieren. Sie sollten eine E-Mail mit dem entsprechenden Code erhalten haben.
	Falls dies nicht der Fall sein sollte wenden sie sich bitten an unseren Support, den Sie über das Kontaltformular erreichen können.</p>

	<form method="post" action="aktivierung.php">

		<label for="nutzername">Benutzername:</label>
		<input type="text" name="nutzername"/>
	  
		<label for="aktivierung">Aktivierungscode:</label>
		<input type="password" name="aktivierung" />

		<input type="submit" value="Aktivieren" name="submit" />
	
	</form>
  
	<?php require_once('includes/footer.php'); ?>

</div><!-- #wrapper -->