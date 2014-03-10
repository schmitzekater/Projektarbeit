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
 
			$db = mysqli_connect(DB_HOST, DB_BENUTZER, DB_PASSWORT, DB_NAME);
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
		 
						echo '<p class="pass">Ihr Passwort wurde erfolgreich geändert.</p>';
		 
					}
					else {
						echo '<p class="fail">Die beiden neuen Passwörter stimmen nicht überein.</p>';
					}
                }
				else {
					echo '<p class="fail">Ihr aktuelles Passwort simmt nicht.</p>';
				}
			}
			else {
				echo '<p class="fail">Sie haben die benötigten Felder nicht ausgefüllt.</p>';
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