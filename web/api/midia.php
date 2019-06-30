<?php
require_once('Base.controller.php');
require_once('../daos/Midia.dao.php');

class MidiaController extends BaseController {
  private $categoriaDAO;
  private $jogoDAO;

  function __construct(){
    parent::__construct(new MidiaDAO());
    $this->categoriaDAO = new CategoriaDAO();
    $this->jogoDAO = new JogoDAO();
  }

  public function post() {
    echo json_encode("MidiaController");
  }

  public function get(){
    $response = $this->dao->buscarTodos();
    
    echo json_encode($response);
  }
}

$controller = new MidiaController();
$controller->listen();

?>