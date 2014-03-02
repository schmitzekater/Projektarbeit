<!doctype html>
<html lang="en">

<head>
	
		<title>Genetikum - GenetikumDb</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="./css/menu.css" />
		<link rel="stylesheet" type="text/css" href="./css/Seite.css" />
		<link rel="stylesheet" type="text/css" href="./css/nav.css" />
		<!-- <link rel="stylesheet" type="text/css" href="./css/style.css" 	media="screen"> -->
		<script src="./js/jquery.js" type="text/javascript"></script>
		<script src="./js/upload.js" type="text/javascript"></script>
		<script type="text/javascript" src="./js/sha1.js"></script>
        <script type="text/javascript" src="./js/md5.js"></script>
        
</head>

<body>
	<div id="container">

<header>
	<img src ="Bilder/bg_header_start_01.jpg" 
	header id="headerpicture">

</header>

<nav>
   

<nav id="nav">
	<ul id="navigation">
		<li><a href="index.php" class="first">Home</a></li>
		<li><a href="#">Services &raquo;</a>
			<ul>
				<li><a href="upload.php">Patentendatenupload</a></li>
				<li><a href="#">MutDatenbankupload</a></li>
				<li><a href="#">Ergebnisse speichern &raquo;</a>			
				
			</ul>
		</li>
		<li><a href="#">Weiterführende Links &raquo;</a>
			<ul>
				<li><a href="http://genome.ucsc.edu/">UCSC</a></li>
				<li><a href="http://www.ncbi.nlm.nih.gov/">NCBI</a></li>
				<li><a href="http://www.genenames.org/">HGNC</a></li>
				
				
				
			</ul>				
		</li>
		
		<li><a href="Kontakt.html" class="last">Kontakt</a></li>
		<li><a href="imprint.html" class="last">Impressum</a></li>
	</ul>
</nav>
</nav>

<section id="content">
		  <article>
		  <p></p>
		  <p></p>
		  <p></p>
		  <p></p>
		  <p>Laden Sie bitte die Dateien hoch. Akzeptiert werden ....</p>
		  <p>Bei fehlerhaften Dateien werden Sie benachrichtigt.</p>
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
		
		<?php
		include "./php/links.php";
		include "./php/static.php";
		?>
	
			<div id="main">
				<p>
					Jetzt wollen wir mal was importieren!
				</p>
				<span id="statusWrapper" class="ui-state-highlight">Status:<span id="status">Ready<br /></span></span>
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
			<div id="subside">
				<h1>Quellen</h1>
				<!-- Die Links hier werden automatisch mit JavaScript eingelesen. -->
			</div>
	
		

  </article>
  </section>

  <aside>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
	<h1>Login</h1>
			<table border="none">
				<form name="login" method="get" action="x"
					onsubmit="popuptest();">
					<tr>
						<td>Benutzername</td>
						<td><input type="text" name="name" length="16"></td>
					</tr>
					<tr>
						<td>Passwort</td>
						<td><input type="text" name="password" length="16"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="knopf" value="speichern"></td>
					</tr>
				</form>
			</table>
			<p></p>
		    <p></p>
			<h1>Subside</h1>
			<p>Hier könnte noch erklärender Text zu main stehen. Lorem ipsum
				dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
				tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
				voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
				Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum
				dolor sit amet. Lorem ipsum dolor sit amet, 
				 </p>

</aside>

<footer>		

<img class="DNABild" src="Bilder/dna-Strang.jpg" width="40" high="50">
<p>für weitere DNA-Info´s nutzen Sie bitte</p>
<p></p>
<p>----------------------------------------------------------------------------------------------------------------------------</p>
<p>fdasdsda</p>
<p>fdasdsda</p>
Copyright
 </footer>
</div>
</body>
</html>
