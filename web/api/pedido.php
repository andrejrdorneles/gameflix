<?php
require_once('Base.controller.php');
require_once('../daos/Pedido.dao.php');


class PedidoController extends BaseController {

  function __construct(){
    parent::__construct(new PedidoDAO());
  }

  public function post() {
    echo json_encode("PedidoController");
  }

  public function get(){
    $response = $this->dao->buscarTodos();
    
    echo json_encode($response);
  }
}

$controller = new PedidoController();
$controller->listen();

?>