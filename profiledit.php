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
			<?php
		require_once('./php/sitzungsstart.php');
        $seitentitel = 'Profil bearbeiten';
		require_once('./php/zugang.php');  
  
    ?>
	
<div id="wrapper">
	
	<?php
	
		require_once('./php/header.php');  
		require_once('./php/menu.php');
				
		if (!isset($_SESSION['id'])) {
			echo '<p class="fail">Um auf diese Seite zugreifen zu k&ouml;nnen, m&uuml;ssen Sie sich <a href="login.php">einloggen</a>.</p>';
			exit();
		}
		
		if (isset($_POST['submit'])) {
 
			$db = mysqli_connect("localhost", "dbuser", "dbuser", "genbank");
				mysqli_set_charset($db, "utf8");
  
			$passwort = mysqli_real_escape_string($db, trim($_POST['password']));
			$newpw = mysqli_real_escape_string($db, trim($_POST['newpw']));
			$wdhnewpw = mysqli_real_escape_string($db, trim($_POST['wdhnewpw']));
			$nutzername = $_SESSION['nutzername'];
  
			if(!empty($passwort) && !empty($newpw) && !empty($wdhnewpw)) { 

				$sql = "SELECT nutzername, passwort FROM nutzer WHERE nutzername = '$nutzername' AND passwort = SHA('$passwort')";
   
				$daten = mysqli_query($db, $sql);
   
				if (mysqli_num_rows($daten) == 1) {
					if ($newpw == $wdhnewpw) {
					
						mysqli_query($db, "UPDATE nutzer SET passwort = SHA('$newpw') WHERE nutzername = '$nutzername'")
							or die(mysqli_error());
							
						mysqli_close($db);
		 
						echo '<p class="pass">Ihr Passwort wurde erfolgreich ge���������ndert.</p>';
		 
					}
					else {
						echo '<p class="fail">Die beiden neuen Passw���������rter stimmen nicht ���������berein.</p>';
					}
                }
				else {
					echo '<p class="fail">Ihr aktuelles Passwort simmt nicht.</p>';
				}
			}
			else {
				echo '<p class="fail">Sie haben die ben���������tigten Felder nicht ausgef���������llt.</p>';
			}  
		}  
	?>

	<form method="post" action="profiledit.php">
 
		<label for="nutzername">Aktuelles Passwort:</label>
		<input type="password" id="password" name="password"/>
	  
		<label for="newpw">Neues Passwort:</label>
		<input type="password" id="newpw" name="newpw" />
	  
		<label for="wdhnewpw">Wiederholung neues Passwort:</label>
		<input type="password" id="wdhnewpw" name="wdhnewpw" />
	  
		<input type="submit" value="Aktivieren" name="submit" />
	
	</form>
  
	<?php require_once('./php/footer.php'); ?>
  
</div> <!-- #wrapper -->
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



