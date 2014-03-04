<?php
global $server, $user, $password, $dbase, $handle;
$server = "localhost";
$user = "dbuser";
$password = "dbuser";
$dbase = "genbank";
$sep = "|";
$mutTable = "mutdat";
$genTable = "genname";

$array = array();
try {
	$handle = fopen('.\Datenbank\Projekt\CSV\BAG3.csv', "r");

} catch(Exception $e) {
	setStatus("Fehler beim Öffnen der Datei.\n" . $e -> getMessage());
	//return;
}

try {
	$fileInfo = pathinfo($handle);
	//Filename = Genname
	$filename = $fileInfo['basename'];
	echo("FIlename:".$filename);
	$fileExtension = $fileInfo['extension'];
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
		echo $header[$i], ": ", $elements[$i], "\n";
		// Ausgabe Überschrift: Element
	}
	$mysqli = connectDB();
	if ($mysqli -> ping()) {
		$genId = checkGen($mysqli, $filename);
		if ($genId < 1) {//es gibt das Gen noch nicht in der Datenbank
			$genId = writeGenToDb($mysqli, $gen);
		} else
			;
		writeMutToDB($elements, $table, $genId);
	} else {
			setStatus("Verbindung zur Datenbank unterbrochen.\n" . $mysqli -> error);
			//return;
	}
	echo "---- End of Element ----\n";
}
function writeGenToDb($mysqli, $gen) {
	$query = "insert into $genTable values( 1, '$gen' )";
	//Auto-Inkrement ist an. 1 ist Dummy.
	$result = mysqli_query($mysqli, $query);
	if (!$result) {
		setStatus("Fehler in der Abfrage.\nQuery: " . $query . "\n" . mysql_error() . "\n");
	} else {
		setStatus("Geänderte Zeilen: " . mysql_affected_rows() . "\n");
	}
	$row = $result -> fetch_assoc();
	$id = $row["idG"];
	return $id;

}

function checkGen($mysqli, $gen) {
	$query = "select idG from $genTable where Name like '$gen';";
	$result = mysqli_query($mysqli, $query);
	$row = $result -> fetch_assoc();
	$id = $row["idG"];
	return $id;
}

function connectDB() {
	try {
		$sql = new mysqli($server, $user, $password, $dbase);
		if ($sql -> connect_errno) {
			setStatus("No Connection to $server ! \n" . $sql -> connect_error);
		} else {
			setStatus("Connection to $server ok \n" . $sql -> host_info . "\n");
		}
	} catch (Exception $e) {
		setStatus("Fehler beim Verbinden mit der Datenbank.\n" . $e -> getMessage());
	}
	return $sql;
}

function writeMutToDb($elements, $table) {

	//Datenbank checken ueberfluessig!
	//$db = mysql_select_db($dbase);
	//if ($db) {echo("Datenbank $dbase ok \n");
	//} else {echo("Datenbankfehler: $dbase\n");
	//}
	$query = "insert into $table values( 0, '$elements[0]','$elements[1]','$elements[2]','$elements[3]','$elements[4]','$elements[5]', '$elements[6]',1 )";
	$result = mysql_query($query);
	if (!$result) {
		echo("Fehler in der Abfrage.\nQuery: " . $query . "\n" . mysql_error() . "\n");
	} else {
		echo("Ge�nderte Zeilen: " . mysql_affected_rows() . "\n");
	}

	mysql_close();
}

function setStatus($msg) {
	echo("Status:" . $msg);
}

function stripLinefeed($text) {
	/**
	 * @@ Funktion die Zeilenumbruch am Ende der CSV-Datei entfernt.
	 * @param text String der als Eingabe dient.
	 */
	return preg_replace('#(?<!\r\n)\r\n(?!\r\n)#', ' ', $text);
}
?>