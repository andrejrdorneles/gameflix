<?php
require_once('Base.controller.php');
require_once('../daos/Operador.dao.php');
require_once('../entidades/Operador.class.php');

class OperadorController extends BaseController {

  function __construct(){
    parent::__construct(new OperadorDAO());
  }

  public function post() {
    echo json_encode("OperadorController");
  }

  public function get(){
    $response = array();
    $consulta = $this->dao->buscarTodos();
    
    while ($row = oci_fetch_array($consulta, OCI_NUM)) {
      $obj = new Operador($row[0], $row[1], $row[2], $row[3], $row[4]);
      array_push($response, $obj);
    }
    
    echo json_encode($response);
  }
}

$controller = new OperadorController();
$controller->listen();

?>