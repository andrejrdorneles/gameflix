<?php
require_once('Base.controller.php');


class ClienteController extends BaseController {
  public function post() {
    echo json_encode("ClienteController");
  }
}

$controller = new ClienteController();
$controller->listen();

?>