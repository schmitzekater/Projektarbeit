<?php

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "dbuser";
  $pass = "dbuser";

  $databaseName = "genbank";
  $tableName = "mutdat";

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
 
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $sql = mysql_query("SELECT * FROM $tableName");          //query
  $results = array();
  while($row = mysql_fetch_assoc($sql))
  {
  	$results[] = array(
  			'id' => $row['idMDat'],
  			'aa' => $row['AA change'],
  			'change' => $row['Change'],
  			'extra' => $row['extraInfo'],
  			'genId' => $row['Genname_idG'],
  			'pheno' => $row['Phenotype'],
  			'protein' => $row['protein'],
  			'nuc' => $row['nucleotide'],
  			'ref' => $row['Reference']
  	);
  }
  
  //--------------------------------------------------------------------------
  // 3) echo result as json
  //--------------------------------------------------------------------------
  //echo("Teil1: ".$array[0]."\nTeil 2: ".$array[1]);
  echo json_encode($results);
 ?>