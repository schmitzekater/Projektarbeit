<?php

// --------------------------------------------------------------------------
// Example php script for fetching data from mysql database
// --------------------------------------------------------------------------

$host = "localhost";
$user = "dbuser";
$pass = "dbuser";

$databaseName = "genbank";
$tableName = "mutdat";
// Get POST variables
$rows = (is_numeric($_GET["rows"]) ? (int)$_GET["rows"] : 13);
static $startRow = 0;

// --------------------------------------------------------------------------
// 1) Connect to mysql database
// --------------------------------------------------------------------------

$con = mysql_connect ( $host, $user, $pass );
$dbs = mysql_select_db ( $databaseName, $con );

// --------------------------------------------------------------------------
// 2) Query database for data
// --------------------------------------------------------------------------

$query = "SELECT * FROM $tableName ";

if ($rows > 1) {
	$query = $query." LIMIT $startRow , $rows";
	$startRow+=$rows;
}
$sql = mysql_query ( $query ); // query
$results = array ();
while ( $row = mysql_fetch_assoc ( $sql ) ) {
	// Build entries (lines) for the JSon
	$results [] = array (
			'id' => $row ['idMDat'],
			'aa' => $row ['AA change'],
			'change' => $row ['Change'],
			'extra' => $row ['extraInfo'],
			'genId' => $row ['Genname_idG'],
			'pheno' => $row ['Phenotype'],
			'protein' => $row ['protein'],
			'nuc' => $row ['nucleotide'],
			'ref' => $row ['Reference']
	);
}

// --------------------------------------------------------------------------
// 3) echo result as json
// --------------------------------------------------------------------------
// send
echo json_encode ( $results );
?>