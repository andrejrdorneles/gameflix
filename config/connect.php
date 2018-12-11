<?php

  $server = 'localhost';
  $user = 'root';
  $password = '';
  $database= 'gameflix';

  $mysqli = new mysqli($server, $user, $password, $database);
  
  if ($mysqli->connect_errno) {
    echo $mysqli->connect_errno, ' ', $mysqli->connect_error;
  }

  mysqli_set_charset($mysqli, "utf8");
?>