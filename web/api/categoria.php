<?php
require_once('Base.controller.php');


class CategoriaController extends BaseController {
  public function post() {
    echo json_encode("CategoriaController");
  }
}

$controller = new CategoriaController();
$controller->listen();

?>