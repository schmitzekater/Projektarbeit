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
		  <article>
		  
<div id="main">
	
		<?php
	
		$seitentitel = 'Passwort zur&uuml;cksetzen';
		require_once('./php/zugang.php');
	?>
	
<div id="wrapper">
	
	<?php
	
		
		require_once('./php/menu.php');
 
		if (isset($_POST['submit'])) {

			$db = mysqli_connect("localhost", "dbuser", "dbuser", "genbank");
			mysqli_set_charset($db, "utf8");
      
			$nutzername = mysqli_real_escape_string($db, trim($_POST['nutzername']));
			$sicherheitscode = mysqli_real_escape_string($db, trim($_POST['sicherheitscode']));
			$passwort = mysqli_real_escape_string($db, trim($_POST['passwort']));
			$passwortwdh = mysqli_real_escape_string($db, trim($_POST['passwortwdh']));

			if (!empty($nutzername) && !empty($sicherheitscode) && !empty($passwort) && !empty($passwortwdh)) {

				$sql = "SELECT nutzername, vergessen FROM nutzer WHERE nutzername = '$nutzername' AND vergessen = '$sicherheitscode'";
				$daten = mysqli_query($db, $sql);
				$zeile = mysqli_fetch_array($daten);

				if ($passwort == $passwortwdh) {	
					if (mysqli_num_rows($daten) == 1) {
		  
						$code = rand(100000, 999999); 
		
						mysqli_query($db, "UPDATE nutzer SET passwort = SHA('$passwort') WHERE nutzername = '$nutzername'")
							or die(mysqli_error());
		 
						mysqli_query($db, "UPDATE nutzer SET vergessen = '$code' WHERE nutzername = '$nutzername'")
							or die(mysqli_error());
		
						echo '<p class="pass">Passwort wurde erfolgreich ge���������ndert. Sie k���������nnen sich nun mit dem neuen Kennwort <a href="login.php">hier</a> einloggen.</p>';
						
						mysqli_close($db);
					}
					else {
						echo '<p class="fail">In der Abfrage ist ein Problem aufgetaucht.</p>';
					}
		
				}
				else {
					echo '<p class="fail">Benutzername/Sicherheitscode falsch.</p>';
				}
			}
			else {
				echo '<p class="fail">Sie m���������ssen Daten eingeben.</p>';
			}
		}
 ?>
 
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

		<label for="nutzername">Benutzername:</label>
		<input type="text" id="nutzername" name="nutzername"/>
	  
		<label for="sicherheitscode">Sicherheitscode:</label>
		<input type="password" id="sicherheitscode" name="sicherheitscode" />
	  
		<label for="passwort">Neues Passwort:</label>
		<input type="password" id="passwort" name="passwort" />
	  
		<label for="passwortwdh">Neues Passwort wiederholen:</label>
		<input type="password" id="passwortwdh" name="passwortwdh" />

		<input type="submit" value="Passwort &auml;ndern" name="submit" />
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




