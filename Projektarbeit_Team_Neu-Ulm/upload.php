<!DOCTYPE html>
<!-- Der HTML5-Doctype ist wirklich so simpel. ;) -->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Genetikum - GenetikumDb</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="./css/menu.css" />
		<link rel="stylesheet" type="text/css" href="./css/main.css" />
		<!-- <link rel="stylesheet" type="text/css" href="./css/style.css" 	media="screen"> -->
		<script type="text/javascript" src="./js/checks.js"></script>
		<script type="text/javascript">
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
				<output id="extensions"></output>
				<input type="button" id="test" value="test" onclick="displayAcceptedExtensions()" />
				<input type="file" id="files" name="files[]"  multiple />
				<output id="list"></output>
                <script type="text/javascript" src="./js/fileExtensions.js">
                </script>
                <script>
                   document.getElementById('files').addEventListener('change', handleFileSelect, false);
                </script>
  				<hr>
				<input type="button" id="upload" value="Upload" disabled="true" onclick="displayAcceptedExtensions()">
				<input type="button" id="upload_cancel" value="Abbrechen" onclick="clearUploadList()">
			</div>
			<div id="subside">
				<!-- Idee von mir: In dieses Menu per Script automatisch die Links generieren lassen durch
				Auslesen einer XML datei.
				Funktionsaufruf: function(xml-Datei);

				Im Aufruf:
				Starte Liste <ul>
				Ã–ffne xml-Datei
				For each element:
				<li> <a href =element.url>element.text</a></li>
				Beende Liste </ul>

				Vorteil: Text wird übersichtlicher. Dank XML einfaches Parsen der Quellen.
				Wenn sich Links ändern, einfach die XML austauschen, und das war's.
				Ausserdem habe ich keinen Bock ständig <li> und <a> zu schreiben.... :)
				-->
				<h1>Quellen</h1>
				<ul>
					<li>
						<a href=".">Quelle 1</a>
					</li>
					<li>
						<a href=".">Quelle 2</a>
					</li>
					<li>
						<a href=".">Noch eine Quelle</a>
					</li>
					<li>
						<a href=".">Maoam!</a>
					</li>
				</ul>
			</div>
		</article>
               
	</body>
</html>
