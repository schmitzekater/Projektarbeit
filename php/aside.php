 <?php
 
  if (isset($_SESSION['nutzername'])) {
  	echo '<div id="side"><h1>Session</h1>';
  	echo '<div class="info"><ul>';
  	echo '<li>Hallo <b>' . $_SESSION['nutzername'] . '</b></a></li></br>';
  	echo '<li><a href="profiledit.php">Passwort &auml;ndern</a></li>';
  	echo '<li><a href="vergessen.php">Passwort vergessen</a></li>';
  	echo '<li><a href="logout.php">Ausloggen</a></li>';
  	echo '</ul></div></div>';
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
