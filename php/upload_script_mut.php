<?php
ChromePhp::log ( 'Php Teil' );
$fn = (isset ( $_SERVER ['HTTP_X_FILENAME'] ) ? $_SERVER ['HTTP_X_FILENAME'] : false);
$gen = "";
$debug = 0;
$fileRows = 0;
$dbRows = 0;
$headerExists = false;
if ($fn) {
	
	ChromePhp::log ( 'fn ist da' );
	/*
	 * TODO: Check if file is already present on the server
	 */
	// AJAX call
	$fullName = $uploadDir . $fn;
	file_put_contents ( $fullName, file_get_contents ( 'php://input' ) );
	setStatus ( "$fn uploaded with Ajax" );
	ChromePhp::log ( 'Vor main im Ajax' );
} else {
	
	ChromePhp::log ( 'fn kam über form' );
	// form submit
	$files = $_FILES ['fileselect'];
	
	foreach ( $files ['error'] as $id => $err ) {
		if ($err == UPLOAD_ERR_OK) {
			$fn = $files ['name'] [$id];
			$fullName = $uploadDir . $fn;
			move_uploaded_file ( $files ['tmp_name'] [$id], $fullName );
			setStatus ( "File $fullName uploaded with form." );
			ChromePhp::log ( 'Vor main im Form' );
		}
	}
}

$array = array ();
try {
	$handle = fopen ( $fullName, "r" );
} catch ( Exception $e ) {
	setStatus ( "Fehler beim &Ouml;ffnen der Datei.\n" . $e->getMessage (), true );
	// return;
}

try {
	$fileInfo = pathinfo ( $fullName );
	// Filename = Genname
	$filename = $fileInfo ['basename'];
	$fileExtension = $fileInfo ['extension'];
	$gen = $fileInfo ['filename'];
	setStatus ( "Full filename: " . $filename . "\n" );
	setStatus ( "Extension: " . $fileExtension . "\n" );
	setStatus ( "Filename: " . $gen . "\n" );
} catch ( Exception $e ) {
	setStatus ( "Fehler in Dateinamenerkennung.\n" . $e->getMessage (), true );
	// return;
}
/*
 * Datei einlesen
 */
if (strcasecmp ( $fileExtension, 'csv' ) != 0) {
	setStatus ( "Datei ist keine CSV-Datei. Bitte laden sie eine korrekte Datei hoch.\n", true );
} else {
	while ( ! feof ( $handle ) ) {
		$buffer = fgets ( $handle ); // Zeile einlesen
		if (strlen ( $buffer ) > 0) 		// Leere Zeilen auslassen
		{
			array_push ( $array, $buffer ); // Zeile in Array pushen
		}
	}
}
fclose ( $handle );
// Datei schlie��en
$firstLine = stripLinefeed ( array_shift ( $array ) ); // Zeilenumbruch entfernen und erste Zeile aus Datei als Ueberschrift
$header = explode ( $sep, $firstLine ); // Header aus erster Zeile erstellen
if (! empty ( $header ) && (strpos ( $header [0], "Change" ) !== false)) // Schauen ob der Header passt.
{
	$headerExists = true;
	setStatus ( "Header gefunden: " . join ( " - ", $header ) . "\n" );
} else { // Abbruch wenn der Header nicht korrekt ist.
	setStatus ( "Header nicht korrekt: " . join ( " - ", $header ) . "\nAbbruch des Imports.\n", true );
	exit ();
}
foreach ( $array as $line ) // Aufteilen des Arrays in Zeilen
{
	$elements = stripLinefeed ( explode ( $sep, $line ) ); // Aufteilen der Zeile in Elemente die durch | getrennt sind.
	$fileRows ++;
	for($i = 0; $i < count ( $elements ); ++ $i) {
		setStatus ( $header [$i] . ": " . $elements [$i] . "\n" ); // Ausgabe Ueberschrift: Element
	}
	$mysqli = connectDB ( $server, $user, $password, $dbase ); // Verbindung zur DB aufbauen
	if ($mysqli->ping ()) { // Verbindung noch aktiv?
		$genId = checkGen ( $mysqli, $gen, $genTable ); // Pruefe, ob das Gen bereits in der Datenbank ist.
		writeMutToDB ( $mysqli, $elements, $mutTable, $genId ); // Mutation in die DB schreiben
	} else {
		setStatus ( "Verbindung zur Datenbank unterbrochen.\n" . $mysqli->error . "\n", true );
		// return;
	}
	try {
		$mysqli->close ();
	} catch ( Exception $e ) {
		setStatus ( "Fehler beim Beenden der Datenbankverbindung.\n" . $e->getMessage . "\n", true );
	}
}
generateSummary (); // Abschliessende Zusammenfassung erstellen
/*
 * ***************** Funktionsblock * *****************
 */
function generateSummary() {
	global $dbRows, $fileRows, $headerExists, $debug;
	if ($headerExists && ($dbRows == $fileRows)) {
		setStatus ( "Import erfolgreich. " . $dbRows . " Eintr&auml;ge in die Datenbank kopiert", true );
		/*
		 * TODO: Preview einbaeuen
		 */
	} else {
		setStatus ( "Import nicht erfolgreich.\n" . $fileRows . " Zeilen wurden gefunden und " . $dbRows . " Zeilen in die DB importiert.\n", true );
		setStatus ( "Header exists: " . $headerExists . "\n" );
	}
	closeHtml ();
	exit ();
}
function writeGenToDb($mysqli, $gen, $genTable) {
	/*
	 * This function inserts a new gen to the gen table. The new created id is returned to the calling function. @param $mysqli @param $gen @param $genTable
	 */
	$query = "insert into $genTable ( `Name`) values( '$gen' )"; // Auto-Inkrement ist an.
	if ($result = $mysqli->query ( $query )) {
		$id = $mysqli->insert_id;
		setStatus ( "Neue ID: " . $id . "\n" );
	} else {
		setStatus ( "Fehler beim Einf&uuml;gen in die Datenbank.\nQuery: " . $query . "\n" . $mysqli->error . "\n", true );
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
		$id = writeGenToDb ( $mysqli, $gen, $genTable ); // Gen in die Datenbank schreiben
	}
	return $id;
}
function connectDB($server, $user, $password, $dbase) {
	try {
		$sql = new mysqli ( $server, $user, $password, $dbase );
		if ($sql->connect_errno) {
			setStatus ( "Keine Verbindung zum Server: $server ! \nINFO: " . $sql->connect_error . "\n", true );
		} else {
			setStatus ( "Verbindung zum Server $server ok. \nINFO: " . $sql->host_info . "\n", true );
		}
	} catch ( Exception $e ) {
		setStatus ( "Fehler beim Verbinden mit der Datenbank.\n" . $e->getMessage () . "\n", true );
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
		$count = $mysqli->affected_rows; // Wie viele Zeilen wurden eingefuegt?
		$dbRows += $count; // Anzahl eingefuegter Zeilen erhöhen
		setStatus ( "Ge&auml;derte Zeilen: " . $mysqli->affected_rows . "\n" );
	} else {
		setStatus ( "Fehler in der Abfrage.\nQuery: " . $query . "\n" . $mysqli->error . "\n", true );
	}
}
function setStatus($msg, $enforce = false) {
	if ($enforce || $GLOBALS ['debug'] == 1) {
		echo ("> " . $msg);
	} else
		;
}
function stripLinefeed($text) {
	/**
	 * @@ Funktion die Zeilenumbruch am Ende der CSV-Datei entfernt.
	 *
	 * @param
	 *        	text String der als Eingabe dient.
	 */
	// return preg_replace('#(?<!\r\n)\r\n(?!\r\n)#', ' ', $text);
	return str_replace ( array (
			"\n",
			"\r\n"
	), '', $text );
}
function closeHtml() {
	print ('</textarea></div></fieldset></div><!-- End main --></article></section><aside><div id="subside"><h1>Quellen</h1><!-- Die Links hier werden automatisch mit JavaScript eingelesen. -->
		</div></aside><footer><?php include "php/footer_Seite.php"; ?></footer></div><!-- End Container --></body></html>') ;
	/*
	 * Ja, diese Funktion ist ganz, ganz schlechter Stil, aber es funktioniert, und die Seite ist zu.
	 * Leider bricht der Aufbau der Seite nach dem PHP-Script ab, dies umgeht dieses Problem.
	 * SHAME ON US!!!!!
	 */
}

?>