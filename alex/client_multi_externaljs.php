<!---------------------------------------------------------------------------
Example client script for JQUERY:AJAX -> PHP:MYSQL example
---------------------------------------------------------------------------->

<html>
<head>
<script language="javascript" type="text/javascript" src="jquery.js"></script>
<script language="javascript" type="text/javascript"
	src="external_multi.js"></script>
</head>
<body>

	<!-------------------------------------------------------------------------
  1) Create some html content that can be accessed by jquery
  -------------------------------------------------------------------------->
	<h2>Client example</h2>
	<h3>Output:</h3>

	<div id="gui">
		<span id="inputWrapper"> Zeilen anzeigen:
			<input type="text" id="rows" cols="2" />
			<!--
			TODO: Hidden input field einbauen, dass die "ab" Zeile-Funktionalität hat.
			 -->
			<br />
			<input type = "button" id="nextRows" value="Next" onClick="getNextData()" />
		</span>
		<input type="button" id="clickMe" value="Dr&uuml;ck mich!"	onClick="getData()" />
		<input type="button" id="toggle"
			value="Tabelle verbergen" onClick="toggleElement('#output')" />
	</div>
	<div id="output">this element will be accessed by jquery and this text
		replaced</div>
</body>
</html>