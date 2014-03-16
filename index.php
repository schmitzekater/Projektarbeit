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

<?php

	require_once('./php/sitzungsstart.php');
	$seitentitel = 'memberarea';
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

<body>
<?php include "./php/nav.php"; ?>

<section id="content">
		  <article>
		 
<div id="main">
			<h1>Herzlich willkommen beim <em>Mutfinder</em></h1>
			<p>Diese Seite bietet ein Tool zur Identifizierung von beschriebenen Mutationen
			   in der Molekulargenetik.
			</p>
			<h2>Beschreibung:</h2>
				<p>Um diese Seite nutzen zu k&ouml;nnen ist es notwendig, sich als Nutzer zu authorisieren.
				Hierzu nutzen Sie bitte die Eingabemaske an der rechten Seite.
				Anschlie&szlig;end k&ouml;nnen Sie unter der Uploadseite eine Liste der gew&uuml;nschten / gefundenen Mutationen hochladen.
				Diese Liste wird dann mit einer internen Datenbank verglichen und falls eine Referenz zu den angegebenen Ver&auml;nderungen
				gefunden wird, wird diese ausgegeben.</p>
				
			<p>Bei Problemen oder Fragen bez&uuml;glich dieses Tools wenden Sie sich bitte an den Administrator. Die Angaben finden Sie im Impressum.</p>
			
			<iframe width="640" height="360" src="//www.youtube.com/embed/kp0esidDr-c?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
				
			
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