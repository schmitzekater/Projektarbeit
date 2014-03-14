<?php
/**
  * @author ComFreek
  * @copyright (C) ComFreek, 2011
  * Written as a tutorial for www.tutorials.de
  */
require_once('../../PhpConsole/__autoload.php');;

$json = array ();
$json ['error'] = false;

$json ['file_uploaded'] = isset ( $_POST ['file'] ['filename']);
 $hans = $_POST ['file']; //Text der CSV-Datei#
// $hans = file_get_contents('php://input');

//$array = array ();
// $content = openFile ( $hans, $array );
 $fileName = $_POST['filename']; //Der Dateiname kommt nun separat
if ($json ['file_uploaded']) {
	
	 $json ['quelle'] = $fileName."\n";//.$hans;
	if (function_exists ( 'mb_strlen' )) {
		$json ['size'] = mb_strlen ( $_POST ['file'] );
	} else {
		$json ['size'] = strlen ( $_POST ['file'] );
	}
	
	$json ['md5'] = md5 ( $_POST ['file'] );
	$json ['sha1'] = sha1 ( $_POST ['file'] );
	
	exit ( json_encode ( $json ) );
}

exit ( '{"error":true}' );

?>