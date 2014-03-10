<!doctype html>
<html lang="en">


	<head>

		<title>Genetikum - GenetikumDb</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="./css/menu.css" />
		<link rel="stylesheet" type="text/css" href="./css/main.css" />
		<link rel="stylesheet" type="text/css" href="./css/nav.css" />
		<link rel="stylesheet" type="text/css" href="./css/footer.css" />
		<!-- <link rel="stylesheet" type="text/css" href="./css/style.css" 	media="screen"> -->
		<script src="./js/jquery.js" type="text/javascript"></script>
		<script src="./js/upload.js" type="text/javascript"></script>
		<script type="text/javascript" src="./js/sha1.js"></script>
		<script type="text/javascript" src="./js/md5.js"></script>
		<script>
            //Folgender Code stammt von : http://think2loud.com/224-reading-xml-with-jquery/
            /**
             * Dieses Script liest eine XML-Datei ein, und baut aus dem Inhalt die Link-Liste.
             * Trennung von Darstellung und Inhalt.
             */
            $(document).ready(function() {
                $.ajax({
                    type : "GET",
                    url : "./xml/db_sources.xml",
                    dataType : "xml",
                    success : function(xml) {
                        $('<div class="items" id="links"></div>').html('<ul>').appendTo('#subside');
                        $(xml).find('link').each(function() {
                            var title = $(this).find('text').text();
                            var url = $(this).find('url').text();
                            $('<div class="items" id="links"></div>').html('<li><a href="' + url + '">' + title + '</a></li>').appendTo('#subside');
                        });
                        $('<div class="items" id="links"></div>').html('</ul>').appendTo('#subside');
                    }
                });
            });
		</script>

	</head>

	<body>			
		
<?php include "./php/nav.php"; ?>

<section id="content">
				<article>
				
<?php

	require_once('./php/sitzungsstart.php');
	$seitentitel = 'Memberarea';
	require_once('./php/zugang.php');
		
	if(isset($_SESSION['nutzername'])) {
		$user = $_SESSION['nutzername'];

		$db = mysqli_connect("localhost", "dbuser", "dbuser", "GenBank");
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
	require_once('./php/header.php');
	require_once('./php/menu.php');
?>

	<?php
		if (!isset($_SESSION['id'])) {
			echo '<p class="fail">Um auf diese Seite zugreifen, m&uuml;ssen Sie sich <a href="login.php">einloggen</a>.</p>';
			exit();
		}
	?>

<p class="info">Sie k&ouml;nnen dies hier sehen, weil sie eingeloggt sind.</p>

<?php require_once('./php/footer.php'); ?>

</div><!-- #wrapper -->

<p class="info">Sie k&ouml;nnen dies hier sehen, weil sie eingeloggt sind.</p>

<p>
						Laden Sie bitte die Dateien hoch. Akzeptiert werden ....
					</p>
					<p>
						Bei fehlerhaften Dateien werden Sie benachrichtigt.
					</p>

					<div id="main">
						<p>
							Jetzt wollen wir mal was importieren!
						</p>
						<span id="statusWrapper" class="ui-state-highlight">Status:<span id="status">Ready
								<br />
							</span></span>
						<span id="testwrapper"><span id="acceptedExtensions"></span></span>
						<!-- <output id="extensions"></output> --></-->
						<form action="all.php" method="post" id="frmUpload" enctype="multipart/form-data">
							<input type="button" id="test" value="Dateitypen anzeigen" onclick="toggleElement('#acceptedExtensions')" />
							<input type="file" id="files" name="files[]"  multiple />
							<span id="ListWrapper" name="UploadListe"><output id="list"></output></span>
							<script type="text/javascript" src="./js/fileExtensions.js"></script>
							<script>
                                document.getElementById('files').addEventListener('change', handleFileSelect, false);

                                displayAcceptedExtensions();
							</script>
							<hr>
							<input type="button" id="upload" 		value="Upload" disabled="true" />
							<input type="button" id="upload_cancel" value="Abbrechen" onclick="clearUploadList()" />
							<input type="button" id="toggle_list"   value="Liste verbergen" onclick="toggleElement('#ListWrapper')" />
						</form>
					</div>

				
					
				</article>
			</section>
			<aside>
				<div id="subside">
					<h1>Quellen</h1>
					<!-- Die Links hier werden automatisch mit JavaScript eingelesen. -->
				</div>
				<?php include "./php/aside.php"; ?>

			</aside>

<footer>
<?php include "./php/footer_Seite.php"; ?>
</footer>
</div>

</body>
</html>


