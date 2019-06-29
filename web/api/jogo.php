<?php
require_once('Base.controller.php');
require_once('../daos/Desenvolvedora.dao.php');
require_once('../daos/Jogo.dao.php');
require_once('../entidades/Desenvolvedora.class.php');
require_once('../entidades/Jogo.class.php');

class JogoController extends BaseController {
  private $desenvolvedoraDAO;

  function __construct(){
    parent::__construct(new JogoDAO());
    $this->desenvolvedoraDAO = new DesenvolvedoraDAO();
  }

  public function post() {
    echo json_encode("JogoController");
  }

  public function get(){
    $response = array();
    $consulta = $this->dao->buscarTodos();
    
    while ($row = oci_fetch_array($consulta, OCI_NUM)) {

      $getEnd = oci_fetch_array($this->desenvolvedoraDAO->buscar($row[5]), OCI_NUM);

      $desenvolvedora = new Desenvolvedora($getEnd[0], $getEnd[1], $getEnd[2]);

      $obj = new Jogo($row[0], $row[1], $row[2], $row[3], $row[4], $desenvolvedora);
      array_push($response, $obj);
    }
    
    echo json_encode($response);
  }
}

$controller = new JogoController();
$controller->listen();

?>