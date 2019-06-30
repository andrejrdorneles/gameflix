<?php
require_once('Base.controller.php');
require_once('../daos/Categoria.dao.php');

class CategoriaController extends BaseController {

  function __construct(){
    parent::__construct(new CategoriaDAO());
  }

  public function post() {
    echo json_encode("CategoriaController");
  }

  public function get(){
    $response = $this->dao->buscarTodos();
    
    echo json_encode($response);
  }
}

$controller = new CategoriaController();
$controller->listen();

?>