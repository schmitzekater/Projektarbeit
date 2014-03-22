<!DOCTYPE html>
<!-- Der HTML5-Doctype ist wirklich so simpel. ;) -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Genetikum - GenetikumDb</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="./css/main.css" />
<link rel="stylesheet" type="text/css" href="./css/nav.css" />
<link rel="stylesheet" type="text/css" href="./css/footer.css" />
<script src="./js/jquery.js" type="text/javascript"></script>
<script src="./js/loadLinks.js" type="text/javascript"></script>
</head>
<body>
	<!-- div container -->
		<?php
		include "php/nav.php";
		include "php/zugang.php";
		include 'php/ChromePhp.php';
		?>
		<section id="content">
		<article>
			<div id="_main">
					<h1>Upload von Mutationsdaten</h1>
							<fieldset>
								<legend>HTML File Upload - Mutationsdaten</legend>
								<input type="button" onclick="window.location.href='upload_mut.php'" value="Weitere Datei importieren." />
								<input type="button" onclick="window.location.href='index.php'" value="Home." />
								<div id="dbOutput">
									<textarea id="textOutput" rows="10" cols="60">
<?php
			include"php/upload_script_mut.php";
					
					?>
							</textarea>
							
						</div>
					</fieldset>
				</div>
			<!-- End main -->
		</article>
	</section>
	<aside>
		<div id="subside">
			<h1>Quellen</h1>
			<!-- Die Links hier werden automatisch mit JavaScript eingelesen. -->
		</div>
	</aside>
	<footer>
			<?php include "php/footer_Seite.php"; ?>
		</footer>
	</div>
	<!-- End Container -->
</body>
</html>

