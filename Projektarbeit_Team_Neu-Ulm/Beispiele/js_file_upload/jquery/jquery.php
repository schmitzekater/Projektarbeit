<?php
/**
  * @author ComFreek
  * @copyright (C) ComFreek, 2011
  * Written as a tutorial for www.tutorials.de
  */
  
  $json = array();
  $json['error'] = false;
  
  // If the file was sent by a form
  
  if ( isset($_FILES['file']) )
  {
    $json['file_uploaded'] = true;
    
    if ( $_FILES['file']['error'] !== 0 )
    {
      $json['error'] = true;
      $json['errno'] = $_FILES['file']['error'];
    }
    else
    {
      $json['size'] = $_FILES['file']['size'];
      $json['md5'] = md5_file( $_FILES['file']['tmp_name'] );
      $json['sha1'] = sha1_file( $_FILES['file']['tmp_name'] );
    }
    
    // This code will call the iframeLoaded() function from all.html which then processes the JSON
    exit('<!doctype html><html><head><title></title></head><body><script type="text/javascript">parent.iframeLoaded('.
         json_encode($json).
         ');</script></body></html>');
  }
  
  // If the file was sent by JavaScript
  else
  {
    $json['file_uploaded'] = isset($_POST['file']);
    if ( $json['file_uploaded'] )
    {
      if ( function_exists('mb_strlen') )
      {
        $json['size'] = mb_strlen($_POST['file']);
      }
      else
      {
        $json['size'] = strlen($_POST['file']);
      }
      
      $json['md5'] = md5($_POST['file']);
      $json['sha1'] = sha1($_POST['file']);
    }
    exit( json_encode($json) );
  }
  exit( '{"error":true}' );
?>