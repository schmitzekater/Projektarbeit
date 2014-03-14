<?php
// $server = "localhost";
// $user = "dbuser";
// $password = "dbuser";
// $dbase = "genbank";
// $sep = "|";
// $mutTable = "mutdat";
// $genTable = "genname";
//require_once('C:\Users\schmitza\workspace\Projektarbeit\php\zugang.php');
//require_once('/Users/carolindressel/Desktop/Eclipse Workspace/Projektarbeit/php/zugang.php');
require_once('./php/zugang.php');
$gen = "";
$debug = 0;
$fileRows = 0;
$dbRows = 0;
$headerExists = false;
/*
 * Debug:
 */
//$datei = 'C:\Users\schmitza\workspace\Projektarbeit\Datenbank\Projekt\CVS Dateien\BAG3.csv';
//$datei = '/Users/carolindressel/Desktop/Eclipse Workspace/Projektarbeit/Datenbank/Projekt/CVS Dateien/BAG3.csv';
//$datei = $_POST['filename'];

main ();
function main() {
	$array = array ();
	$content = openFile ( $GLOBALS ['datei'], $array ); //Datei �ffnen
	$changes = writeToDb ( $content [0], $content [1] );//Elemente in die Datenbank schreiben
	generateSummary ();									//Zusammenfassung erstellen, wie viele Datens�tze geschrieben wurden.
}
function openFile($file, $array) {
	global $gen;
	global $headerExists;
	try {
		$handle = fopen ( $file, "r" );
	} catch ( Exception $e ) {
		setStatus ( "Fehler beim &Ouml;ffnen der Datei.\n" . $e->getMessage () );
		// return;
	}
	
	try {
		$fileInfo = pathinfo ( $file );
		// Filename = Genname
		$filename = $fileInfo ['basename'];
		$fileExtension = $fileInfo ['extension'];
		$gen = $fileInfo ['filename'];
		setStatus ( "Full filename:" . $filename . "\n" );
		setStatus ( "Extension:" . $fileExtension . "\n" );
		setStatus ( "Filename:" . $gen . "\n" );
	} catch ( Exception $e ) {
		setStatus ( "Fehler in Dateinamenerkennung.\n" . $e->getMessage () );
		// return;
	}
	/*
	 * Datei einlesen
	 */
	if (strcasecmp ( $fileExtension, 'csv' ) != 0) {
		setStatus ( "Datei ist keine CSV-Datei. Bitte laden sie eine korrekte Datei hoch." );
	} else {
		while ( ! feof ( $handle ) ) {
			$buffer = fgets ( $handle );
			// Zeile einlesen
			if (strlen ( $buffer ) > 0) 			// Leere Zeilen auslassen
			{
				array_push ( $array, $buffer );
				// Zeile in Array pushen
			}
		}
	}
	fclose ( $handle );
	// Datei schlie��en
	$header = stripLinefeed ( array_shift ( $array ) );
	if (! empty ( $header ) && (strpos ( $header, "Change" ) !== false)) 	// Schauen ob der Header passt.
	{
		$headerExists = true;
		setStatus ( "Header gefunden: " . $header . "\n" );
	} else {
		/*
		 * TODO: Abbruch, da der Header fehlt.
		 */
		setStatus ( "Header nicht korrekt: " . $header . "\n" );
	}
	$values = array();
	$values[0] = $header;
	$values[1] = $array;
	return $values;
}
// Zeilenumbruch entfernen und erste Zeile aus Datei als ��berschrift
function writeToDB($header, $array) {
	global $sep, $fileRows, $server, $user, $password, $dbase, $gen, $genTable, $mutTable;
	$header = explode ( $sep, $header );
	// Header aus erster Zeile erstellen
	$mysqli = connectDB ( $server, $user, $password, $dbase );
	if ($mysqli->ping ()) { // Verbindung noch aktiv?
		$genId = checkGen ( $mysqli, $gen, $genTable );
		// Pr��fe, ob das Gen bereits in der Datenbank ist.
	} else {
		setStatus ( "Verbindung zur Datenbank unterbrochen.\n" . $mysqli->error );
		// return -1, Grund;
	}
	// Verbindung zur DB aufbauen
	foreach ( $array as $line ) 	// Aufteilen des Arrays in Zeilen
	{
		$elements = stripLinefeed ( explode ( $sep, $line ) );
		// Aufteilen der Zeile in Elemente die durch | getrennt sind.
		$fileRows ++;
		for($i = 0; $i < count ( $elements ); ++ $i) {
			setStatus ( $header [$i] . ": " . $elements [$i] . "\n" );
			// Ausgabe ��berschrift: Element
		}
		if ($mysqli->ping ()) { // Verbindung noch aktiv?
			writeMutToDB ( $mysqli, $elements, $mutTable, $genId );
		// Mutation in die DB schreiben
		} else {
			setStatus ( "Verbindung zur Datenbank unterbrochen.\n" . $mysqli->error );
			// return -1, Grund;
		}
		
	}
	try {
		$mysqli->close ();
	} catch ( Exception $e ) {
		setStatus ( "Fehler beim Beenden der Datenbankverbindung.\n" . $e->getMessage . "\n" );
	}
	; // Anzahl Elemente zur�ckgeben;
}
function generateSummary() {
	global $dbRows, $fileRows, $headerExists, $debug;
	$debug = 1;
	if ($headerExists && ($dbRows == $fileRows)) {
		setStatus ( "Import erfolgreich. " . $dbRows . " Eintr�ge in die Datenbank kopiert");
	} else {
		setStatus ( "Import nicht erfolgreich.\n" . $fileRows . " wurden gefunden und " . $dbRows . " importiert.\n");
		setStatus ( "Header exists: " . $headerExists . "\n");
	}
	/*
	 * TODO: R�ckgabewert einrichten f�r Aufrufeseite.
	 */
}
function writeGenToDb($mysqli, $gen, $genTable) {
	/*
	 * This function inserts a new gen to the gen table. The new created id is returned to the calling function. @param $mysqli @param $gen @param $genTable
	 */
	$query = "insert into $genTable ( `Name`) values( '$gen' )";
	// Auto-Inkrement ist an.
	if ($result = $mysqli->query ( $query )) {
		$id = $mysqli->insert_id;
		setStatus ( "Neue ID: " . $id . "\n" );
	} else {
		setStatus ( "Fehler beim Einf��gen in die Datenbank.\nQuery: " . $query . "\n" . $mysqli->error . "\n" );
	}
	$mysqli->close ();
	return $id;
}
function checkGen($mysqli, $gen, $genTable) {
	/*
	 * This function tries to retrieve the id of a unique gen. If the Gen is not present in the database, a new ID will be generated. @param $mysqli @param $gen @param $genTable
	 */
	$query = 'select idG from ' . $genTable . ' where Name = "' . $gen . '";';
	if (($result = $mysqli->query ( $query )) && ($result2 = $mysqli->affected_rows) == 1) 	// ID war bereits vorhanden
	{
		$row = $result->fetch_assoc ();
		$id = $row ['idG'];
	} else {
		$id = writeGenToDb ( $mysqli, $gen, $genTable );
		// Gen in die Datenbank schreiben
	}
	return $id;
}
function connectDB($server, $user, $password, $dbase) {
	try {
		$sql = new mysqli ( $server, $user, $password, $dbase );
		if ($sql->connect_errno) {
			setStatus ( "No Connection to Server $server ! \nINFO: " . $sql->connect_error . "\n" );
		} else {
			setStatus ( "Connection to Server $server ok. \nINFO: " . $sql->host_info . "\n" );
		}
	} catch ( Exception $e ) {
		setStatus ( "Fehler beim Verbinden mit der Datenbank.\n" . $e->getMessage () );
	}
	return $sql;
}
function writeMutToDb($mysqli, $elements, $table, $genId) {
	/*
	 * This functions inserts mutation values to the database. @param $mysqli @param $elements @param $table @param $genId
	 */
	global $dbRows;
	$query = "insert into $table values( 0, '$elements[0]','$elements[1]','$elements[2]','$elements[3]','$elements[4]','$elements[5]', '$elements[6]',$genId )";
	if ($result = $mysqli->query ( $query )) {
		$count = $mysqli->affected_rows;
		setStatus ( "Ge&auml;nderte Zeilen: " . $count . "\n" );
		$dbRows += $count;
		setStatus ( "Anzahl Zeilen in der DB: " . $dbRows . "\n\n" );
	} else {
		setStatus ( "Fehler in der Abfrage.\nQuery: " . $query . "\n" . $mysqli->error . "\n" );
	}
}
function setStatus($msg) {
	if ($GLOBALS ['debug'] == 1) {
		echo ("Status:" . $msg);
	} else
		;
}
function stripLinefeed($text) {
	/**
	 * @@ Funktion die Zeilenumbruch am Ende der CSV-Datei entfernt.
	 * @param text String der als Eingabe dient.
	 */
	return str_replace(array("\n","\r\n"), '',$text);
}
?>