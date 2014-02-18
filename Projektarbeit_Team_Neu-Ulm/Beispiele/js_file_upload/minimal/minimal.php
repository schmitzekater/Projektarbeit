<?php
  // This script only output a litte phrase with the count of chars in the file

  if ( isset( $_POST['file'] ) )
  {
    echo 'File uploaded in $_POST[\'file\']: ';
    echo 'true (size: ';
    if ( function_exists('mb_strlen') )
    {
      echo mb_strlen($_POST['file']);
    }
    else
    {
      echo strlen($_POST['file']);
    }
    echo 'chars)';
  }
  else
  {
    echo 'false';
  }
?>