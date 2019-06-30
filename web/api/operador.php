<?php
require_once('Base.controller.php');
require_once('../daos/Operador.dao.php');

class OperadorController extends BaseController {

  function __construct(){
    parent::__construct(new OperadorDAO());
  }

  public function get(){
    $response = $this->dao->buscarTodos();
    
    echo json_encode($response);
  }
}

$controller = new OperadorController();
$controller->listen();

?>