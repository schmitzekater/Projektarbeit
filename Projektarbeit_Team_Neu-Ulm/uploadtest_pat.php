<?php
$server = "localhost";
$user = "dbuser";
$password = "dbuser";
$dbase = "genbank";
$sep = "|";
$mutTable = "mutp";
$patTable = "pat";
$debug = 1;
/*
 * Debug:
 */
$datei = '.\Datenbank\Projekt\CSV\patient1.csv';

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
	$name = $fileInfo['filename'];
	setStatus("Full filename:" . $filename . "\n");
	setStatus("Extension:" . $fileExtension . "\n");
	setStatus("Name:" . $name . "\n");
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
		$patId = checkpat($mysqli, $name, $patTable);
		//Prüfe, ob der Patient bereits in der Datenbank ist.
		writePatToDB($mysqli, $header, $elements, $patTable, $patId);
		//Patienten in die DB schreiben
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
function addPatToDb($mysqli, $pat, $patTable) {
	/*
	 * This function inserts a new patient to the patient table.
	 * The new created id is returned to the calling function.
	 * @param $mysqli
	 * @param $pat
	 * @param $patTable
	 */
	$query = "insert into $patTable ( `Name`) values( '$pat' )";
	//Auto-Inkrement ist an.
	if ($result = $mysqli -> query($query)) {
		$id = $mysqli -> insert_id;
		setStatus("Neue ID: " . $id . "\n");
	} else {
		setStatus("Fehler beim Einfügen in die Datenbank.\nQuery: " . $query . "\n" . $mysqli -> error . "\n");
		$id = -1;
	}
	$mysqli -> close();
	return $id;
}

function checkPat($mysqli, $pat, $patTable) {
	/*
	 * This function tries to retrieve the id of a unique patient.
	 * If the patient is not present in the database, a new ID will be generated.
	 * @param $mysqli
	 * @param $pat
	 * @param $patTable
	 */
	$query = 'select idPat from ' . $patTable . ' where Name = "' . $pat . '";';
	if (($result = $mysqli -> query($query)) && ($result2 = $mysqli -> affected_rows) == 1)//ID war bereits vorhanden
	{
		$row = $result -> fetch_assoc();
		$id = $row['idPat'];
	} else {
		$id = addPatToDb($mysqli, $pat, $patTable);
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
function arrayToString($array)
{
	 $werte = "";
		 foreach($array as $u)
	 {
	 	$werte = $werte.",`".$u."`";
	 }
	 unset($u);
	 $cut = substr($werte,1);	//erstes Komma und ' abschneiden
	 setStatus("Cut: ".$cut."\n");
	 return $cut;
}
function writePatToDb($mysqli, $header, $elements, $table, $patId) {
	/*
	 * This functions inserts mutation values to the database.
	 * @param $mysqli
	 * @param $elements
	 * @param $table
	 * @param $patId
	 */
	 $columns = arrayToString($header);
	 $values  = arrayToString($elements);	 	

	$query = "insert into $table (`idMP`, $columns, `Pat_idPat`) values( 0, $values,$patId )";
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