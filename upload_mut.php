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


<!DOCTYPE html>
<!-- Der HTML5-Doctype ist wirklich so simpel. ;) -->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Genetikum - GenetikumDb - Gendaten-Upload</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
		<link rel="stylesheet" type="text/css" href="./css/main.css" />
		<link rel="stylesheet" type="text/css" href="./css/nav.css" />
		<link rel="stylesheet" type="text/css" href="./css/footer.css" />
		<link rel="stylesheet" type="text/css" href="./css/style-login.css" />
		<!-- <link rel="stylesheet" type="text/css" href="./css/style.css" 	media="screen"> -->
		<script src="./js/jquery.js" type="text/javascript"></script>
		<script src="./js/loadLinks.js" type="text/javascript"></script>
		<script src="./js/fileExtensions.js" type = "text/javascript"></script>
	<link rel="shortcut icon" href="Bilder/__favicon.ico">
	</head>
	<body>
		<!-- div container -->
				<?php
				include "./php/nav.php"; // Nav beinhaltet auch den Header
				?>
				


<section id="content">
				<article>
				
					<div id="_main">
					
	
<div id="wrapper">

<?php
	require_once('./php/menu.php');
?>

	<?php
		if (!isset($_SESSION['id'])) {
			echo '<p class="fail">Um auf diese Seite zugreifen, m&uuml;ssen Sie sich <a href="login.php">einloggen</a>.</p>';
			echo '</div>	<!-- End main -->
					</article>
					</section>

					<aside>
					<div id="subside">
					<h1>Quellen</h1>
					<p></p>   <!-- Die Links hier werden automatisch mit JavaScript eingelesen. -->
					</div>
					</aside>
					<footer>
				
					</footer>
					</div> <!-- End Container -->
					</body>
					</html>

					</div><!-- #wrapper -->	';
			
			
			
			
			exit();
		}
	?>
	

		<p class="info">Sie k&ouml;nnen dies hier sehen, weil sie eingeloggt sind.</p>

		<h1>Upload von Mutationsdaten</h1>
						<form id="upload" action="upload_mut2.php" method="POST"	enctype="multipart/form-data">
							<fieldset>
								<legend><b>HTML File Upload - Mutationsdaten</b></legend>
								<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
								<div>
									<label for="fileselect">Files to upload:</label>
									<input	type="file" id="fileselect" name="fileselect[]"	multiple="multiple" />
									<span id="ListWrapper" name="UploadListe"><output id="list"></output></span>
									
									<div id="submitbutton">
									<button type="submit" id="upload-button">Upload Files</button>
								</div>
								<div id="filedrag">
									<span id="dropspan"><p></p>
									or drop files here</span>
								</div>
								</div>
								
							</fieldset>
							<iframe id='my_iframe' name='my_iframe' src=""></iframe>
						</form>
					<script type="text/javascript">
						// file selection
						function FileSelectHandler(e) {
				
							// cancel event and hover styling
							FileDragHover(e);
							document.getElementById('upload-button').target = 'my_iframe';
							//'my_iframe' is the name of the iframe
							//document.getElementById('my_form').submit();
				
							// fetch FileList object
							var files = e.target.files || e.dataTransfer.files;
				
							// process all File objects
							for (var i = 0, f; f = files[i]; i++) {
								ParseFile(f);
								UploadFile(f);
							}
						}
						function UploadFile(file) {
				
							var xhr = new XMLHttpRequest();
							if (xhr.upload  && file.size <= $id("MAX_FILE_SIZE").value) {
								// start upload
								xhr.open("POST", $id("upload").action, true);
								xhr.setRequestHeader("X_FILENAME", file.name);
								xhr.send(file);
							}
						}
					</script>
				
					</div>	<!-- End main -->
				</article>
			</section>

			<aside>
				<div id="subside">
					<h1>Quellen</h1>
					<!-- Die Links hier werden automatisch mit JavaScript eingelesen. -->
				</div>
					<?php include "php/aside.php"; ?>
			</aside>
			<footer>
				<?php include "php/footer_Seite.php"; ?>
			</footer>
		</div> <!-- End Container -->
	</body>
</html>


<?php require_once('includes/footer.php'); ?>


	</div><!-- #wrapper -->				
					