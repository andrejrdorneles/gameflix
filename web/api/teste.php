<?php
require_once('Base.controller.php');


class Teste extends BaseController {
  public function post() {
    echo getenv('PRD');
  }
}

$teste = new Teste();
$teste->listen();

?>