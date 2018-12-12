<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type");

  $request_method = $_SERVER['REQUEST_METHOD'];
  $postdata = file_get_contents("php://input");
  $data = json_decode($postdata);

?>