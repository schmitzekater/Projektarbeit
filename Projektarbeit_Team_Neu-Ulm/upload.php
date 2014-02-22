<!DOCTYPE html>
<!-- Der HTML5-Doctype ist wirklich so simpel. ;) -->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Genetikum - GenetikumDb</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="./css/menu.css" />
		<link rel="stylesheet" type="text/css" href="./css/main.css" />
		<!-- <link rel="stylesheet" type="text/css" href="./css/style.css" 	media="screen"> -->
		<script src="./js/jquery.js" type="text/javascript"></script>
		<script src="./js/upload.js" type="text/javascript"></script>
		<script type="text/javascript" src="./js/sha1.js"></script>
        <script type="text/javascript" src="./js/md5.js"></script>
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
		include "./php/links.php";
		include "./php/static.php";
		?>
		<article>
			<div id="main">
				<p>
					Jetzt wollen wir mal was importieren!
				</p>
				<span id="statusWrapper" class="ui-state-highlight">Status:<span id="status">Ready</span></span>
				<output id="extensions"></output>
				<form action="all.php" method="post" id="frmUpload" enctype="multipart/form-data">
					<input type="button" id="test" value="test" onclick="displayAcceptedExtensions()" />
					<input type="file" id="files" name="files[]"  multiple />
					<output id="list"></output>
					<script type="text/javascript" src="./js/fileExtensions.js"></script>
					<script>
						document.getElementById('files').addEventListener('change', handleFileSelect, false);
					</script>
					<hr>
					<input type="button" id="upload" 		value="Upload" disabled="true">
					<input type="button" id="upload_cancel" value="Abbrechen" onclick="clearUploadList()">
				</form>
			</div>
			<div id="subside">
				<h1>Quellen</h1>
				<!-- Die Links hier werden automatisch mit JavaScript eingelesen. -->
			</div>
		</article>
	</body>
</html>
