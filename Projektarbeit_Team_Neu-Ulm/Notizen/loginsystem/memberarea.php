<?php

	require_once('includes/sitzungsstart.php');
	$seitentitel = 'Memberarea';
	require_once('includes/zugang.php');
		
	if(isset($_SESSION['nutzername'])) {
		$user = $_SESSION['nutzername'];

		$db = mysqli_connect(DB_HOST, DB_BENUTZER, DB_PASSWORT, DB_NAME);
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

<div id="wrapper">

<?php
	require_once('includes/header.php');
	require_once('includes/menu.php');
?>

	<?php
		if (!isset($_SESSION['id'])) {
			echo '<p class="fail">Um auf diese Seite zugreifen, m&uuml;ssen Sie sich <a href="login.php">einloggen</a>.</p>';
			exit();
		}
	?>

<p class="info">Sie k&ouml;nnen dies hier sehen, weil sie eingeloggt sind.</p>

<?php require_once('includes/footer.php'); ?>

</div><!-- #wrapper -->