<?php

  $server = 'localhost/xe';
  $user = 'GAMEFLIX';
  $password = 'GAMEFLIX';

  if(getenv('PRD')){
    $server = getenv('SERVER');
    $server = getenv('USER');
    $server = getenv('PASSWORD');
  }

  $conn = oci_connect($user, $password, $server);
  if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  }

  $GLOBALS['conn'] = $conn;

?>