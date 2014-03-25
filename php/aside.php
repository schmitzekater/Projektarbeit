 <?php
 
  if (isset($_SESSION['nutzername'])) {
  	echo '<div id="side"><ul>';
  	echo '<li>Hallo (' . $_SESSION['nutzername'] . ')</a></li>';
  	echo '<li><a href="profiledit.php">Passwort &auml;ndern</a></li>';
  	echo '<li><a href="logout.php">Ausloggen</a></li>';
  	echo '</ul></div>';
  }
  else{
  	echo '<H2>Information</H2>';
 	echo '<br />';
	echo '<p>Um die Funktionen dieser Seite nutzen zu k&ouml;nnen, ist ein <em><a href=login.php>&raquo; Login </a></em> notwendig. </p>';
	echo '<hr class=linie3>';
	echo '<p>Falls Sie noch nicht registriert sind, k&ouml;nnen Sie dies unter  <em><a href=registrieren.php>&raquo; Registrieren </a></em> tun.</p>';
	echo '<p>Wir w&uuml;nschen viel Freude mit dieser Webseite</p>';
  }
  
?>
