<?php
require_once('Base.controller.php');
require_once('../daos/Desenvolvedora.dao.php');
require_once('../entidades/Desenvolvedora.class.php');

class DesenvolvedoraController extends BaseController {

  function __construct(){
    parent::__construct(new DesenvolvedoraDAO());
  }

  public function post() {
    echo json_encode("DesenvolvedoraController");
  }

  public function get(){
    $response = array();
    $consulta = $this->dao->buscarTodos();
    
    while ($row = oci_fetch_array($consulta, OCI_NUM)) {
      $obj = new Desenvolvedora($row[0], $row[1], $row[2]);
      array_push($response, $obj);
    }
    
    echo json_encode($response);
  }
}

$controller = new DesenvolvedoraController();
$controller->listen();

?>