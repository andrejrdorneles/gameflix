<?php

  // $db = mysqli_init();
  // $db->ssl_set(PATH_TO_SSL_CLIENT_KEY_FILE, PATH_TO_SSL_CLIENT_CERT_FILE, PATH_TO_CA_CERT_FILE, null, null);
  // $db->real_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_NAME);

  $server = 'us-cdbr-iron-east-01.cleardb.net';
  $user = 'b7dd97901cca9c';
  $password = '6591c14d';
  $database= 'heroku_5627424df39c2ee';

  $mysqli = new mysqli($server, $user, $password, $database);
  
  if ($mysqli->connect_errno) {
    echo $mysqli->connect_errno, ' ', $mysqli->connect_error;
  }

  mysqli_set_charset($mysqli, "utf8");
?>