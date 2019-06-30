<?php
require_once('Base.controller.php');
require_once('../daos/Locacao.dao.php');

class LocacaoController extends BaseController {
  private $categoriaDAO;
  private $jogoDAO;

  function __construct(){
    parent::__construct(new LocacaoDAO());
    $this->categoriaDAO = new CategoriaDAO();
    $this->jogoDAO = new JogoDAO();
  }

  public function post() {
    echo json_encode("LocacaoController");
  }

  public function get(){
    $response = $this->dao->buscarTodos();
    
    echo json_encode($response);
  }
}

$controller = new LocacaoController();
$controller->listen();

?>