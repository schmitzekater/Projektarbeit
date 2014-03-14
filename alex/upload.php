<!DOCTYPE html>
<!-- Der HTML5-Doctype ist wirklich so simpel. ;) -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Genetikum - GenetikumDb</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/footer.css" />
<!-- <link rel="stylesheet" type="text/css" href="./css/style.css" 	media="screen"> -->
<script src="./js/jquery.js" type="text/javascript"></script>

<!--	<script type="text/javascript">
		//http://www.html5rocks.com/de/tutorials/file/dndfiles/
		// Check for the various File API support.
		if (window.File && window.FileReader && window.FileList && window.Blob) {
		// Great success! All the File APIs are supported.
		} else {
		alert('The File APIs are not fully supported in this browser. \nUpload is not possible, please choose another browser.');
		}
		function startUpload() {
		alert('Jetzt kann es los gehen!');
		}
		</script> -->
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
		<?php
		include "./php/nav.php";
		?>
		<section id="content">
		<article>
			<div id="main">
				<form id="upload" action="upload_handler.php" method="POST"
					enctype="multipart/form-data">

					<fieldset>
						<legend>HTML File Upload</legend>

						<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE"
							value="300000" />

						<div>
							<label for="fileselect">Files to upload:</label> <input
								type="file" id="fileselect" name="fileselect[]"
								multiple="multiple" />
							<div id="filedrag">or drop files here</div>
						</div>

						<div id="submitbutton">
							<button type="submit">Upload Files</button>
						</div>

					</fieldset>
					<iframe id='my_iframe' name='my_iframe' src=""></iframe>

				</form>
				<script type="text/javascript">
		// file selection
		function FileSelectHandler(e) {

			// cancel event and hover styling
			FileDragHover(e);
			document.getElementById('upload').target = 'my_iframe';
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
		// upload JPEG files
		function UploadFile(file) {

			var xhr = new XMLHttpRequest();
			if (xhr.upload && file.type == "image/jpeg" && file.size <= $id("MAX_FILE_SIZE").value) {
				// start upload
				xhr.open("POST", $id("upload").action, true);
				xhr.setRequestHeader("X_FILENAME", file.name);
				xhr.send(file);

			}

		}
		</script>
		
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
	</container>
	</div>
	<!-- End main -->

</body>
</html>
