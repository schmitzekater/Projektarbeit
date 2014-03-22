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
	<!-- jQuery and jQuery UI -->
    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
    

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
<div id="container">
<?php include "./php/nav.php"; ?>

<section id="content">
		  <article>
		 
<div id="main">

			<span id="statusWrapper" class="ui-state-highlight">Status: <span id="status">Ready</span></span>
        
        <br />
        <progress value="0" max="100" id="pgrStatus"></progress>
        <hr />
      
        <form action="getPatList.php" method="post" id="listLoad" enctype="multipart/form-data">
          <input type="submit" id="listLoad" value="Hole Patientenliste" />
        </form>
			
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