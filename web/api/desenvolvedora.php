<?php
require_once('Base.controller.php');


class DesenvolvedoraController extends BaseController {
  public function post() {
    echo json_encode("DesenvolvedoraController");
  }
}

$controller = new DesenvolvedoraController();
$controller->listen();

?>