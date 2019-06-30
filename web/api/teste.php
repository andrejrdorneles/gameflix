<?php
$postdata = file_get_contents("php://input");
$data = json_decode($postdata);

echo json_encode($data);

?>