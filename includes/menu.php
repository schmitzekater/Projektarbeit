<?php
  // Navigationsmen� generieren
  if (isset($_SESSION['nutzername'])) {
    echo '<div id="menu"><ul><li><a href="index.php">Home</a></li>';
	echo '<li><a href="uploadmitMenu.php">Patientenupload</a></li>';
	echo '<li><a href="profiledit.php">Passwort �ndern</a></li>';
	echo '<li><i>Sie sind eingeloggt</i></li>';
	echo '<li><a href="logout.php">Ausloggen (' . $_SESSION['nutzername'] . ')</a></li></ul></div>';
	}
	else {
	  echo '<div id="menu"><ul><li><a href="login.php">Einloggen</a></li>';
	  echo '<li><a href="registrieren.php">Registrieren</a></li>';
	  echo '<li><a href="index.php">feel lucky...</a></li></div>';
	}
?>