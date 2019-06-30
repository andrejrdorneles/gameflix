<?php
require_once('Base.controller.php');
require_once('../daos/Pedido.dao.php');

class PedidoController extends BaseController {

  function __construct(){
    parent::__construct(new PedidoDAO());
  }

}

$controller = new PedidoController();
$controller->listen();

?>