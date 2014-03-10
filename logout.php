<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
<title>GenBank</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/main.css" />
	<link rel="stylesheet" type="text/css" href="./css/nav.css" />
	<link rel="stylesheet" type="text/css" href="./css/footer.css" />


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

<p>Um sich wieder einzuloggen verwenden Sie diesen Link ... oder w��hlen Sie im Men�� LOGIN</p>

			<?php	
		session_start();
		if (isset($_SESSION['id'])) {
		
			// Sitzungsvariablen l��schen
			$_SESSION = array();

			// Sitzungs-Cookie l��schen
			if (isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time() - 3600);
			}
			session_destroy();
		}

		// Cookies l��schen
		setcookie('id', '', time() - 3600);
		setcookie('nutzername', '', time() - 3600);

		$hauptseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
			header('Location: ' . $hauptseite);
?>


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
