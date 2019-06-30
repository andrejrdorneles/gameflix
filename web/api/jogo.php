<?php
require_once('Base.controller.php');
require_once('../daos/Jogo.dao.php');

class JogoController extends BaseController {

  function __construct(){
    parent::__construct(new JogoDAO());
  }

  public function post() {
    echo json_encode("JogoController");
  }

  public function get(){
    $response = $this->dao->buscarTodos();
    
    echo json_encode($response);
  }
}

$controller = new JogoController();
$controller->listen();

?>