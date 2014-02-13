<!DOCTYPE html>
<!-- Der HTML5-Doctype ist wirklich so simpel. ;) -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Genetikum - GenetikumDb</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="./css/menu.css" />
<link rel="stylesheet" type="text/css" href="./css/main.css" />
<link rel="stylesheet" href="css/style.css" type="text/css"
	media="screen">
<script type="text/javascript" src="checks.js">	</script>
<script type="text/javascript">
		//http://www.html5rocks.com/de/tutorials/file/dndfiles/
		// Check for the various File API support.
		if (window.File && window.FileReader && window.FileList && window.Blob) {
		  // Great success! All the File APIs are supported.
		} else {
		  alert('The File APIs are not fully supported in this browser.');
		}
		</script>
</head>

<body>
	<?php
	include ("./php/links.php");
	include "./php/static.php"
	?>
	<article>
		<div id="main">
			<p>Jetzt wollen wir mal was importieren!</p>
			<input type="file" id="files" name="files[]" multiple />
			<output id="list"></output>

			<script>
 				 function handleFileSelect(evt) {
  					  var files = evt.target.files; // FileList object

   					 // files is a FileList of File objects. List some properties.
					    var output = [];
					    for (var i = 0, f; f = files[i]; i++) {
					      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
					                  f.size, ' bytes, last modified: ',
					                  f.lastModifiedDate.toLocaleDateString(), '</li>');
					    }
				    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
				  }
  				document.getElementById('files').addEventListener('change', handleFileSelect, false);
			</script>
		</div>
		<div id="subside">
		<!-- Idee von mir: In dieses Menu per Script automatisch die Links generieren lassen durch
			 Auslesen einer XML datei.
			 Funktionsaufruf: function(xml-Datei);
			 
			 Im Aufruf:
			 Starte Liste <ul>
			 Öffne xml-Datei
			 For each element:
			 <li> <a href =element.url>element.text</a></li>
			 Beende Liste </ul>
			 
			 Vorteil: Text wird übersichtlicher. Danke XML einfaches Parsen der Quellen.
			 		  Wenn sich Links ändern, einfach die XML austauschen, und das war's.
			 		  Ausserdem habe ich keinen Bock ständig <li> und <a> zu schreiben.... :)
			  -->
			<h1>Quellen</h1>
			<ul>
				<li><a href=".">Quelle 1</a></li>
				<li><a href=".">Quelle 2</a></li>
				<li><a href=".">Noch eine Quelle</a></li>
				<li><a href=".">Maoam!</a></li>
			</ul>
		</div>
	</article>
</body>
</html>
