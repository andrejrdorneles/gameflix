<?php
require_once('Base.controller.php');
require_once('../daos/Desenvolvedora.dao.php');

class DesenvolvedoraController extends BaseController {

  function __construct(){
    parent::__construct(new DesenvolvedoraDAO());
  }

  public function post() {
    echo json_encode("DesenvolvedoraController");
  }

  public function get(){
    $response = $this->dao->buscarTodos();
    
    echo json_encode($response);
  }
}

$controller = new DesenvolvedoraController();
$controller->listen();

?>