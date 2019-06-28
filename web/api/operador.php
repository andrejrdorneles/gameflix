<?php
require_once('Base.controller.php');


class OperadorController extends BaseController {
  public function post() {
    echo json_encode("OperadorController");
  }
}

$controller = new OperadorController();
$controller->listen();

?>