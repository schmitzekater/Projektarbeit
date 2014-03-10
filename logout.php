<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
<title>GenBank</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/main.css" />
	<link rel="stylesheet" type="text/css" href="./css/nav.css" />


</head>

<body>
<?php include "./php/nav.php"; ?>

<section id="content">
		  <article>
		  <p></p>
		  <p></p>
<h1>&nbsp;</h1>
<div id="main">

<h2>Logout</H2>

<p>Sie haben sich ausgeloggt....</p>

<p>Um sich wieder einzuloggen verwenden Sie diesen Link ... oder wählen Sie im Menü LOGIN</p>

			<?php	
		session_start();
		if (isset($_SESSION['id'])) {
		
			// Sitzungsvariablen löschen
			$_SESSION = array();

			// Sitzungs-Cookie löschen
			if (isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time() - 3600);
			}
			session_destroy();
		}

		// Cookies löschen
		setcookie('id', '', time() - 3600);
		setcookie('nutzername', '', time() - 3600);

		$hauptseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
			header('Location: ' . $hauptseite);
?>


  </article>
  </section>

  <aside>
  
  
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
			<H2>Information</H2>
			<p></p>
		  
			<p>Um die Funktionen dieser Seite nutzen zu können, ist ein Login notwendig. </p>
			<p><a href="login.php">Login </a></p>
			<p>Falls Sie noch nicht registriert sind, können Sie dies unter  <a href="registrieren.php">Registrieren </a> tun.</p>
			<p>Wir wünschen viel Freude mit dieser Webseite</p>
  

</aside>


<footer>		

<img class="DNABild" src="Bilder/dna-Strang.jpg" width="40" high="50">
<p>für weitere DNA-Info´s nutzen Sie bitte</p>

<p></p>
<p>----------------------------------------------------------------------------------------------------------------------------</p>
<p>fdasdsda</p>
<p>fdasdsda</p>
Copyright
</footer>
</div>
</body>
</html>
