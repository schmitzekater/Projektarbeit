<?php
require_once 'zugang.php';
$tableName = "pat";
// Get POST variables
$rows = (is_numeric ( $_GET ["rows"] ) ? ( int ) $_GET ["rows"] : 13);
static $startRow = 0;

$con = mysql_connect ( $server, $user, $password );
$dbs = mysql_select_db ( $dbase, $con );

//$query = "SELECT * FROM $tableName ";

$query = 'SELECT p.Name, m.Gene, m.Location, m.Type, m.Hint, m.HGVSnomenclature, m.`Pos.`, m.`AA Change`, m.`Nuc Change`
		FROM pat p, mutp m
		WHERE p.idPat = m.Pat_idPat';
 

if ($rows > 0) {
	$query = $query . " LIMIT $startRow , $rows";
	$startRow += $rows;
}
$sql = mysql_query ( $query ); // query
$results = array ();
while ( $row = mysql_fetch_assoc ( $sql ) ) {
	// Build entries (lines) for the JSon
	$results [] = array (
			'name' => $row ['Name'],
			'gene' => $row ['Gene'],
			'loc'  => $row ['Location'],
			'type' => $row ['Type'],
			'hint' => $row ['Hint'],
			'hgvs' => $row ['HGVSnomenclature'],
			'pos'  => $row ['Pos.'],
			'achg' => $row ['AA Change'],
			'nchg' => $row ['Nuc Change']
	);
}
echo json_encode ( $results );
?>