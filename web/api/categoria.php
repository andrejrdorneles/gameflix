<?php
require_once('Base.controller.php');
require_once('../daos/Categoria.dao.php');
require_once('../entidades/Categoria.class.php');

class CategoriaController extends BaseController {

  function __construct(){
    parent::__construct(new CategoriaDAO());
  }

  public function post() {
    echo json_encode("CategoriaController");
  }

  public function get(){
    $response = array();
    $consulta = $this->dao->buscarTodos();
    
    while ($row = oci_fetch_array($consulta, OCI_NUM)) {
      $obj = new Categoria($row[0], $row[1], $row[2]);
      array_push($response, $obj);
    }
    
    echo json_encode($response);
  }
}

$controller = new CategoriaController();
$controller->listen();

?>