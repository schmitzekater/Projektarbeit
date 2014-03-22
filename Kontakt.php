
<?php

	require_once('./php/sitzungsstart.php');
	$seitentitel = 'Memberarea';
	require_once('./php/zugang.php');
		
	if(isset($_SESSION['nutzername'])) {
		$user = $_SESSION['nutzername'];

		$db = mysqli_connect("localhost","dbuser","dbuser","genbank");
			mysqli_set_charset($db, "utf8");

		$sql = "SELECT aktiviert, nutzername FROM nutzer WHERE nutzername = '$user' ";
		$daten = mysqli_query($db, $sql);
		$zeile = mysqli_fetch_array($daten);

		if ($zeile['aktiviert'] == 0) {

			$aktivierungsseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/aktivierung.php';
				header('Location:' . $aktivierungsseite);

			mysqli_close($db);

		}		
	}
	
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
<title>Genetikum - GenetikumDb - GenBank</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/main.css" />
	<link rel="stylesheet" type="text/css" href="./css/nav.css" />
	<link rel="stylesheet" type="text/css" href="./css/footer.css" />
	<link rel="stylesheet" type="text/css" href="./css/style-login.css" />
	<link rel="shortcut icon" href="Bilder/__favicon.ico">

</head>


<body>
<div id="container">
<?php include "./php/nav.php"; ?>

<section id="content">
		  <article>
		 
<div id="main">

		<H1>Kontakt</H1>
	
	<hr class="linie2">

	<p>Alexander Schmitz Carolin Schwerdtfeger</p>

	<p>Wegerstrasse</p>

	<p>Neu-Ulm</p>
	
	<iframe
		src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5300.34357846409!2d10.005611000000012!3d48.376436149999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479966c5cad77523%3A0x3b25d9bf005e807d!2sWegenerstra%C3%9Fe!5e0!3m2!1sde!2sde!4v1393693113076"
		width="600" height="450" frameborder="0" style="border: 0"></iframe>
		


			
		</div>

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








