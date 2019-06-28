<?php
require_once('Base.controller.php');


class MidiaController extends BaseController {
  public function post() {
    echo json_encode("MidiaController");
  }
}

$controller = new MidiaController();
$controller->listen();

?>