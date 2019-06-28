<?php
require_once('Base.controller.php');


class PedidoController extends BaseController {
  public function post() {
    echo json_encode("PedidoController");
  }
}

$controller = new PedidoController();
$controller->listen();

?>