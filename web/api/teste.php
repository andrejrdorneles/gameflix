<?php
require_once('base_controller.php');


class Teste extends BaseController {
  public function post() {
    echo json_encode($this->data);
  }
}

$teste = new Teste();
$teste->listen();

?>