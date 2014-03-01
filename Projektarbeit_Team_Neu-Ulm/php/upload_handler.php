<?php
/**
 * @author ComFreek
 * @copyright (C) ComFreek, 2011
 * Written as a tutorial for www.tutorials.de
 */
function stripLinefeed($text) {
	/**
	 * @@ Funktion die Zeilenumbruch am Ende der CSV-Datei entfernt.
	 * @param text String der als Eingabe dient.
	 */
	return preg_replace('#(?<!\r\n)\r\n(?!\r\n)#', ' ', $text);
}

function readFile($file) {
	$handle = fopen($file, "r");
	$array = array();
	while (!feof($handle)) {
		$buffer = fgets($handle);
		// Zeile einlesen
		if (strlen($buffer) > 0)// Leere Zeilen auslassen
		{
			array_push($array, $buffer);
			//Zeile in Array pushen
		}
	}
	fclose($handle);
	// Datei schließen
	$firstLine = stripLinefeed(array_shift($array));
	// Zeilenumbruch entfernen und erste Zeile aus Datei als Überschrift
	$header = explode("|", $firstLine);
	$json['header'] = "hemem";
	// Header aus erster Zeile erstellen
	foreach ($array as $line)// Aufteilen des Arrays in Zeilen
	{
		$elements = stripLinefeed(explode("|", $line));
		// Aufteilen der Zeile in Elemente die durch | getrennt sind.
		for ($i = 0; $i < count($elements); ++$i) {
			echo $header[$i], ": ", $elements[$i], "\n";
			// Ausgabe Überschrift: Element
		}
		echo "---- End of Element ----\n";
	}

}

$json = array();
$json['error'] = false;

// If the file was sent by a form

if (isset($_FILES['file'])) {
	$json['file_uploaded'] = true;

	if ($_FILES['file']['error'] !== 0) {
		$json['error'] = true;
		$json['errno'] = $_FILES['file']['error'];
	} else {
		$json['size'] = $_FILES['file']['size'];
		$json['md5'] = md5_file($_FILES['file']['tmp_name']);
		$json['sha1'] = sha1_file($_FILES['file']['tmp_name']);
	}

	// This code will call the iframeLoaded() function from all.html which then processes the JSON
	exit('<!doctype html><html><head><title></title></head><body><script type="text/javascript">parent.iframeLoaded(' . json_encode($json) . ');</script></body></html>');
}

// If the file was sent by JavaScript
else {
	$json['file_uploaded'] = isset($_POST['file']);
	if ($json['file_uploaded']) {
		if (function_exists('mb_strlen')) {
			$json['size'] = mb_strlen($_POST['file']);
		} else {
			$json['size'] = strlen($_POST['file']);
		}

		$json['md5'] = md5($_POST['file']);
		$json['sha1'] = sha1($_POST['file']);
		/*
		 * Zeilenweises einlesen der Datei
		 */
		//readFile($_POST['file']);

	}
	exit(json_encode($json));
}
exit('{"error":true}');
?>