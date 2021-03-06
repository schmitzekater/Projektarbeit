<?php
/*
 * Zentrale Datei, die alle Zugangsdaten enthaelt, die fuer die Datenbankoperationen noetig sind.
 */

	define('DB_HOST', 'localhost');
	define('DB_BENUTZER', 'dbuser');
	define('DB_PASSWORT', 'dbuser');
	define('DB_NAME', 'genbank');

	$server = "localhost";
	$user = "dbuser";
	$password = "dbuser";
	$dbase = "genbank";
	$sep = "|";				//CSV-Trenner
	$mutTable = "mutdat";	//Liste der Mutationen
	$genTable = "genname";	//Liste der Gene
	$patTable = "pat";		//Patientenliste
	$patMutTable = "mutp";	//Liste der Mutationen pro Patient
	$uploadDir = "Datenbank/uploads/"	//Verzeichnis zum Speichern der CSV-Dateien auf Server-Seite
	
?>
