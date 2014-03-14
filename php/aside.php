 <?php
 
  if (isset($_SESSION['nutzername'])) {
  	
  	echo '<p></p>
  	<p></p>
  	<p></p>
  	<p></p>
  	<p></p><div id="menu"><ul><li>Hallo (' . $_SESSION['nutzername'] . ')</a></li></ul>
  	<p></p>
  							  <li><a href="logout.php">Ausloggen (' . $_SESSION['nutzername'] . ')</a></li></ul></div>';
  }
  else{
  echo 
  '	<p></p>
  	<p></p>
  	<p></p>
  	<p></p>
  	<p></p>
			<H2>Information</H2>
			<p></p>
		  
			<p>Um die Funktionen dieser Seite nutzen zu k&ouml;nnen, ist ein Login notwendig. </p>
			<p><a href="login.php">Login </a></p>
			<p>Falls Sie noch nicht registriert sind, k&ouml;nnen Sie dies unter  <a href="registrieren.php">Registrieren </a> tun.</p>
			<p>Wir w&uuml;nschen viel Freude mit dieser Webseite</p>';
  	
  }
  
?>  