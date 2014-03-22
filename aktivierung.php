<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
<title>GenBank</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./css/main.css" />
	<link rel="stylesheet" type="text/css" href="./css/nav.css" />
	<link rel="stylesheet" type="text/css" href="./css/footer.css" />
	<link rel="stylesheet" type="text/css" href="./css/style-login.css" />


</head>

<body>
<div id="container">
<?php include "./php/nav.php"; ?>



<section id="content">
		 
<div id="main">
	
	<?php
		$seitentitel = 'Aktivieren';
		require_once('./php/zugang.php');
?>
	
<div id="wrapper">
	
	<?php
		
		require_once('./php/menu.php');

		// Mit Datenbank verbinden
		$db = mysqli_connect("localhost", "dbuser", "dbuser", "genbank");
			mysqli_set_charset($db, "utf8");

			if (isset($_POST['submit'])) {

				$nutzername = mysqli_real_escape_string($db, trim($_POST['nutzername']));
				$code = mysqli_real_escape_string($db, trim($_POST['aktivierung']));

				if(!empty($nutzername) && !empty($code)) {
  
					$sql = "SELECT * FROM nutzer WHERE nutzername = '$nutzername' AND aktivierungscode = '$code'";
					$daten = mysqli_query($db, $sql);
					$zeile = mysqli_fetch_array($daten);
   
					if (mysqli_num_rows($daten) == 1) {
					
						echo '<p class="pass">Ihr Account wurde erfolgreich aktiviert. <a href="/uploadmitMenu.php">Patientanupload</a></p>';
		 
						mysqli_query($db, "UPDATE nutzer SET aktiviert = '1' WHERE nutzername = '$nutzername'")
							or die(mysqli_error());
						
						mysqli_close($db);
					}
					else {
						'<p class="fail">Die angegebenen Daten sind leider falsch.</p>';
					}

				}  
				else {
					echo '<p class="fail">Sie haben vergessen Daten einzugeben.</p>';
				} 
			}
	?>

	<h2>Account aktivieren</h2>

	<p>Sie m&uuml;ssen ihren Account noch aktivieren. Sie sollten eine E-Mail mit dem entsprechenden Code erhalten haben.
	Falls dies nicht der Fall sein sollte wenden sie sich bitten an unseren Support, den Sie &uuml;ber das Kontaltformular erreichen k&ouml;nnen.</p>

	<form method="post" action="aktivierung.php">

		<label for="nutzername">Benutzername:</label>
		<input type="text" name="nutzername"/>
	  
		<label for="aktivierung">Aktivierungscode:</label>
		<input type="password" name="aktivierung" />

		<input type="submit" value="Aktivieren" name="submit" />
	
	</form>
  
	

</div><!-- #wrapper -->

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



