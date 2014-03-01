<?php
$handle = fopen('C:\Users\schmitza\git\Projektarbeit\Projektarbeit_Team_Neu-Ulm\Datenbank\CVS Dateien\BAG3CVS', "r");
$array = array();
while (!feof($handle)) {
	$buffer = fgets($handle);							// Zeile einlesen
	if(strlen($buffer)>0)								// Leere Zeilen auslassen
	{
		array_push($array, $buffer);					//Zeile in Array pushen
	}
}
fclose($handle);										// Datei schließen
$firstLine = stripLinefeed(array_shift($array));        // Zeilenumbruch entfernen und erste Zeile aus Datei als Überschrift
$header = explode("|", $firstLine);						// Header aus erster Zeile erstellen
foreach ($array as $line)								// Aufteilen des Arrays in Zeilen
{
	$elements = stripLinefeed(explode("|", $line));   	// Aufteilen der Zeile in Elemente die durch | getrennt sind.
	for ($i = 0; $i < count($elements); ++$i) {
		echo $header[$i], ": ", $elements[$i], "\n";	// Ausgabe Überschrift: Element
	}
	echo "---- End of Element ----\n";
}

function stripLinefeed($text)
{
	/**
	 * @@ Funktion die Zeilenumbruch am Ende der CSV-Datei entfernt.
	 * @param text String der als Eingabe dient.
	 */
	return preg_replace('#(?<!\r\n)\r\n(?!\r\n)#', ' ', $text);
}
?>