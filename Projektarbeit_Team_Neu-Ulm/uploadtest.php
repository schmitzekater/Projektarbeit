<?php
$server = "localhost";
$user = "dbuser";
$password = "dbuser";
$dbase = "genbank";
$sep = "|";
$mutTable = "mutdat";
$genTable = "genname";
$debug = 1;
/*
 * Debug:
 */
$datei = '.\Datenbank\Projekt\CSV\BAG3.csv';

$array = array();
try {
	$handle = fopen($datei, "r");

} catch(Exception $e) {
	setStatus("Fehler beim Öffnen der Datei.\n" . $e -> getMessage());
	//return;
}

try {
	$fileInfo = pathinfo($datei);
	//Filename = Genname
	$filename = $fileInfo['basename'];
	$fileExtension = $fileInfo['extension'];
	$gen = $fileInfo['filename'];
	setStatus("Full filename:" . $filename . "\n");
	setStatus("Extension:" . $fileExtension . "\n");
	setStatus("Filename:" . $gen . "\n");
} catch (Exception $e) {
	setStatus("Fehler in Dateinamenerkennung.\n" . $e -> getMessage());
	//return;
}
/*
 * Datei einlesen
 */
if (strcasecmp($fileExtension, 'csv') != 0) {
	setStatus("Datei ist keine CSV-Datei. Bitte laden sie eine korrekte Datei hoch.");
} else {
	while (!feof($handle)) {
		$buffer = fgets($handle);
		// Zeile einlesen
		if (strlen($buffer) > 0)// Leere Zeilen auslassen
		{
			array_push($array, $buffer);
			//Zeile in Array pushen
		}
	}
}
fclose($handle);
// Datei schließen
$firstLine = stripLinefeed(array_shift($array));
// Zeilenumbruch entfernen und erste Zeile aus Datei als Überschrift
$header = explode($sep, $firstLine);
// Header aus erster Zeile erstellen
foreach ($array as $line)// Aufteilen des Arrays in Zeilen
{
	$elements = stripLinefeed(explode($sep, $line));
	// Aufteilen der Zeile in Elemente die durch | getrennt sind.
	for ($i = 0; $i < count($elements); ++$i) {
		setStatus($header[$i]. ": ". $elements[$i]. "\n");
		// Ausgabe Überschrift: Element
	}
	$mysqli = connectDB($server, $user, $password, $dbase);
	//Verbindung zur DB aufbauen
	if ($mysqli -> ping()) {//Verbindung noch aktiv?
		$genId = checkGen($mysqli, $gen, $genTable);
		//Prüfe, ob das Gen bereits in der Datenbank ist.
		writeMutToDB($mysqli, $elements, $mutTable, $genId);
		//Mutation in die DB schreiben
	} else {
		setStatus("Verbindung zur Datenbank unterbrochen.\n" . $mysqli -> error);
		//return;
	}
	try {
		$mysqli -> close();
	} catch(Exception $e) {
		setStatus("Fehler beim Beenden der Datenbankverbindung.\n" . $e -> getMessage . "\n");
	}
}
function writeGenToDb($mysqli, $gen, $genTable) {
	/*
	 * This function inserts a new gen to the gen table.
	 * The new created id is returned to the calling function.
	 * @param $mysqli
	 * @param $gen
	 * @param $genTable
	 */
	$query = "insert into $genTable ( `Name`) values( '$gen' )";
	//Auto-Inkrement ist an.
	if ($result = $mysqli -> query($query)) {
		$id = $mysqli -> insert_id;
		setStatus("Neue ID: " . $id . "\n");
	} else {
		setStatus("Fehler beim Einfügen in die Datenbank.\nQuery: " . $query . "\n" . $mysqli -> error . "\n");
	}
	$mysqli -> close();
	return $id;
}

function checkGen($mysqli, $gen, $genTable) {
	/*
	 * This function tries to retrieve the id of a unique gen.
	 * If the Gen is not present in the database, a new ID will be generated.
	 * @param $mysqli
	 * @param $gen
	 * @param $genTable
	 */
	$query = 'select idG from ' . $genTable . ' where Name = "' . $gen . '";';
	if (($result = $mysqli -> query($query)) && ($result2 = $mysqli -> affected_rows) == 1)//ID war bereits vorhanden
	{
		$row = $result -> fetch_assoc();
		$id = $row['idG'];
	} else {
		$id = writeGenToDb($mysqli, $gen, $genTable);
		//Gen in die Datenbank schreiben
	}
	return $id;
}

function connectDB($server, $user, $password, $dbase) {
	try {
		$sql = new mysqli($server, $user, $password, $dbase);
		if ($sql -> connect_errno) {
			setStatus("No Connection to Server $server ! \nINFO: " . $sql -> connect_error . "\n");
		} else {
			setStatus("Connection to Server $server ok. \nINFO: " . $sql -> host_info . "\n");
		}
	} catch (Exception $e) {
		setStatus("Fehler beim Verbinden mit der Datenbank.\n" . $e -> getMessage());
	}
	return $sql;
}

function writeMutToDb($mysqli, $elements, $table, $genId) {
	/*
	 * This functions inserts mutation values to the database.
	 * @param $mysqli
	 * @param $elements
	 * @param $table
	 * @param $genId
	 */

	$query = "insert into $table values( 0, '$elements[0]','$elements[1]','$elements[2]','$elements[3]','$elements[4]','$elements[5]', '$elements[6]',$genId )";
	if ($result = $mysqli -> query($query)) {
		setStatus("Geänderte Zeilen: " . $mysqli -> affected_rows . "\n");
	} else {
		setStatus("Fehler in der Abfrage.\nQuery: " . $query . "\n" . $mysqli -> error . "\n");
	}

}

function setStatus($msg) {
	if ($GLOBALS['debug'] = 1) {
		echo("Status:" . $msg);
	} else
		;
}

function stripLinefeed($text) {
	/**
	 * @@ Funktion die Zeilenumbruch am Ende der CSV-Datei entfernt.
	 * @param text String der als Eingabe dient.
	 */
	return preg_replace('#(?<!\r\n)\r\n(?!\r\n)#', ' ', $text);
}
?>