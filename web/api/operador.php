<?php
require_once('Base.controller.php');
require_once('../daos/Operador.dao.php');

class OperadorController extends BaseController {

  function __construct(){
    parent::__construct(new OperadorDAO());
  }

}

$controller = new OperadorController();
$controller->listen();

?>