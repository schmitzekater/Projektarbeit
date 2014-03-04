<?php
$server="localhost";
$user="dbuser";
$password="dbuser";
$dbase="GenBank";
$handle = fopen('./Datenbank/Projekt/CVS Dateien/BAG3CVS', "r");

$array = array();
while (!feof($handle)) {
	$buffer = fgets($handle);							// Zeile einlesen
	if(strlen($buffer)>0)								// Leere Zeilen auslassen
	{
		array_push($array, $buffer);					//Zeile in Array pushen
	}
}
fclose($handle);										// Datei schlie�en
$firstLine = stripLinefeed(array_shift($array));        // Zeilenumbruch entfernen und erste Zeile aus Datei als �berschrift
$header = explode("|", $firstLine);						// Header aus erster Zeile erstellen
foreach ($array as $line)								// Aufteilen des Arrays in Zeilen
{
	$elements = stripLinefeed(explode("|", $line));   	// Aufteilen der Zeile in Elemente die durch | getrennt sind.
	for ($i = 0; $i < count($elements); ++$i) {
		echo $header[$i], ": ", $elements[$i], "\n";	// Ausgabe �berschrift: Element
	}
	writeToDB($elements, "MutDat");
	echo "---- End of Element ----\n";
}

function writeToDb($elements, $table)
{
	global $server, $user, $password, $dbase;
		$sql = mysql_connect($server, $user, $password);
		echo("Status:");
		if($sql)
			{echo("Connection to $server ok \n");}
		else
			{echo("No Connection to $server ! \n");}
		
		//Datenbank checken
		$db = mysql_select_db($dbase);
		if($db)
			{echo("Datenbank $dbase ok \n");}
		else
			{echo("Datenbankfehler: $dbase\n");}
		$query = 	"insert into $table values( 0, '$elements[0]','$elements[1]','$elements[2]','$elements[3]','$elements[4]','$elements[5]', '$elements[6]',1 )";
		$result = mysql_query($query);
		if(!$result){
			echo("Fehler in der Abfrage.\nQuery: ".$query."\n".mysql_error()."\n");
		}
		else{
			echo("Ge�nderte Zeilen: ".mysql_affected_rows()."\n");
		}
		
		mysql_close();
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