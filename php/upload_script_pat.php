<?php
ChromePhp::log ( 'Php Teil' );
$fn = (isset ( $_SERVER ['HTTP_X_FILENAME'] ) ? $_SERVER ['HTTP_X_FILENAME'] : false);
$gen = "";
$debug = 0;
$fileRows = 0;
$dbRows = 0;
$headerExists = false;
$hostPost = false;
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
	$name = $fileInfo ['filename'];
	setStatus ( "Full filename:" . $filename . "\n" );
	setStatus ( "Extension:" . $fileExtension . "\n" );
	setStatus ( "Name:" . $name . "\n" );
} catch ( Exception $e ) {
	setStatus ( "Fehler in Dateinamenerkennung.\n" . $e->getMessage (), true );
	// return;
}
/*
 * Datei einlesen
 */
if (strcasecmp ( $fileExtension, 'csv' ) != 0) {
	setStatus ( "Datei ist keine CSV-Datei. Bitte laden sie eine korrekte Datei hoch.", true );
} else {
	while ( ! feof ( $handle ) ) {
		$buffer = fgets ( $handle );
		// Zeile einlesen
		if (strlen ( $buffer ) > 0) 		// Leere Zeilen auslassen
		{
			array_push ( $array, $buffer );
			// Zeile in Array pushen
		}
	}
}
fclose ( $handle );
// Datei schliessen
$firstLine = stripLinefeed ( array_shift ( $array ) );

// Zeilenumbruch entfernen und erste Zeile aus Datei als ��berschrift
$header = explode ( $sep, $firstLine ); // Header aus erster Zeile erstellen
if (! empty ( $header ) && (strpos ( $header [0], "Index" ) !== false)) // Schauen ob der Header passt.
{
	$headerExists = true;
	setStatus ( "Header gefunden: " . join ( " - ", $header ) . "\n" );
} else { // Abbruch wenn der Header nicht korrekt ist.
	setStatus ( "Header nicht korrekt: " . join ( " - ", $header ) . "\nAbbruch des Imports.\n", true );
	exit ();
}
foreach ( $array as $line ) // Aufteilen des Arrays in Zeilen
{
	$elements = stripLinefeed ( explode ( $sep, $line ) );
	$fileRows++;
	// Aufteilen der Zeile in Elemente die durch | getrennt sind.
	for($i = 0; $i < count ( $elements ); ++ $i) {
		setStatus ( $header [$i] . ": " . $elements [$i] . "\n" );
		// Ausgabe ��berschrift: Element
	}
	$mysqli = connectDB ( $server, $user, $password, $dbase );
	// Verbindung zur DB aufbauen
	if ($mysqli->ping ()) { // Verbindung noch aktiv?
		$patId = checkpat ( $mysqli, $name, $patTable );
		// Pr��fe, ob der Patient bereits in der Datenbank ist.
		writePatMutToDB ( $mysqli, $header, $elements, $patMutTable, $patId );
		// Patienten in die DB schreiben
	} else {
		setStatus ( "Verbindung zur Datenbank unterbrochen.\n" . $mysqli->error, true );
		// return;
	}
	try {
		$mysqli->close ();
	} catch ( Exception $e ) {
		setStatus ( "Fehler beim Beenden der Datenbankverbindung.\n" . $e->getMessage . "\n", true );
	}
}
generateSummary();

/*
 ******************
 * Funktionsblock *
 ******************
 */
function generateSummary() {
	global $dbRows, $fileRows, $headerExists, $debug;
	if ($headerExists && ($dbRows == $fileRows)) {
		setStatus ( "Import erfolgreich. " . $dbRows . " Eintr&auml;ge in die Datenbank kopiert", true);
		/*
		 * TODO: Preview einbaeuen
		*/
	} else {
		setStatus ( "Import nicht erfolgreich.\n" . $fileRows . " Zeilen wurden gefunden und " . $dbRows . " Zeilen in die DB importiert.\n", true);
		setStatus ( "Header exists: " . $headerExists . "\n");
	}
	closeHtml();
	exit();
}
function addPatToDb($mysqli, $pat, $patTable) {
	/*
	 * This function inserts a new patient to the patient table. The new created id is returned to the calling function. @param $mysqli @param $pat @param $patTable
	 */
	$query = "insert into $patTable ( `Name`) values( '$pat' )";
	// Auto-Inkrement ist an.
	if ($result = $mysqli->query ( $query )) {
		$id = $mysqli->insert_id;
		setStatus ( "Neue ID: " . $id . "\n" );
	} else {
		setStatus ( "Fehler beim Einf&uuml;gen in die Datenbank.\nQuery: " . $query . "\n" . $mysqli->error . "\n", true );
		$id = - 1;
	}
	$mysqli->close ();
	return $id;
}
function checkPat($mysqli, $pat, $patTable) {
	/*
	 * This function tries to retrieve the id of a unique patient. If the patient is not present in the database, a new ID will be generated. @param $mysqli @param $pat @param $patTable
	 */
	$query = 'select idPat from ' . $patTable . ' where Name = "' . $pat . '";';
	if (($result = $mysqli->query ( $query )) && ($result2 = $mysqli->affected_rows) == 1) 	// ID war bereits vorhanden
	{
		$row = $result->fetch_assoc ();
		$id = $row ['idPat'];
	} else {
		$id = addPatToDb ( $mysqli, $pat, $patTable );
		// Patient in die Datenbank schreiben
	}
	return $id;
}
function connectDB($server, $user, $password, $dbase) {
	global $hostPost;
	try {
		$sql = new mysqli ( $server, $user, $password, $dbase );
		if ($sql->connect_errno) {
			setStatus ( "No Connection to Server $server ! \n> INFO: " . $sql->connect_error . "\n", true );
		} else if(!$hostPost){
			setStatus ( "Connection to Server $server ok. \n> INFO: " . $sql->host_info . "\n", true );
			$hostPost=true;
		}
	} catch ( Exception $e ) {
		setStatus ( "Fehler beim Verbinden mit der Datenbank.\n" . $e->getMessage (), true );
	}
	return $sql;
}
function arrayToString($array, $sign) {
	$werte = "";
	foreach ( $array as $u ) {
		setStatus ( "Gefundenes u: " . $u . " - " );
		$werte = $werte . "," . $sign . $u . $sign;
		// $werte = $werte.",".$u;
	}
	unset ( $u );
	$cut = substr ( $werte, 1 ); // erstes Komma und ' abschneiden hinten ' anf�gen
	                             // $cut = substr($werte, 1, -1); //erstes und letztes Komma abschneiden
	setStatus ( "\nCut: " . $cut . "\n" );
	return $cut;
}
function writePatMutToDb($mysqli, $header, $elements, $table, $patId) {
	/*
	 * This functions inserts mutation values to the database. @param $mysqli @param $elements @param $table @param $patId
	 */
	global $dbRows;
	$columns = arrayToString ( $header, '`' ); // Spaltennamen mit ` umgeben
	$values = arrayToString ( $elements, "'" ); // Werte mit ' umgeben
	
	$query = "insert into `$table` (`idMP`, $columns, `Pat_idPat`) values( 0, $values,$patId )";
	// $query = "insert into $table (idMP, $columns, Pat_idPat) values( 0, $values,$patId )";
	if ($result = $mysqli->query ( $query )) {
		$count = $mysqli->affected_rows;										// Wie viele Zeilen wurden eingefuegt?
		$dbRows += $count;														// Anzahl eingefuegter Zeilen erhöhen
		setStatus ( "Ge&auml;nderte Zeilen: " . $mysqli->affected_rows . "\n" );
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
	$text = str_replace("'","\\'", $text); 					// Patientendatei enthält ein ' in einer Zeile, dies muss maskiert werden.
	return str_replace ( array ("\n","\r\n"	), '', $text ); // Obiger Ausdruck entfernt das singulaere LF nicht.
	
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
