 <?php
 
  if (isset($_SESSION['nutzername'])) {
  	
  	echo '<p></p>
  		  <p></p>	<div id="side"><ul><li>Hallo (' . $_SESSION['nutzername'] . ')</a></li></ul></div>
  	
  	<p></p>
  	<p></p>	
  	<div id="side"><ul><li><a href="logout.php">Ausloggen</a></li></ul></div>';
  }
  else{
  echo
  "			<H2>Information</H2>
			<br />
		  	<p>Um die Funktionen dieser Seite nutzen zu k&ouml;nnen, ist ein <em><a href=login.php>&raquo; Login </a></em> notwendig. </p>
			<hr class=linie3>
			<p>Falls Sie noch nicht registriert sind, k&ouml;nnen Sie dies unter  <em><a href=registrieren.php>&raquo; Registrieren </a></em> tun.</p>
			<p>Wir w&uuml;nschen viel Freude mit dieser Webseite</p>";
  	
  }
  
?>
