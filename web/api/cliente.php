<?php
require_once('Base.controller.php');
require_once('../daos/Cliente.dao.php');
require_once('../daos/Endereco.dao.php');
require_once('../entidades/Cliente.class.php');
require_once('../entidades/Endereco.class.php');

class ClienteController extends BaseController {
  private $enderecoDAO;

  function __construct(){
    parent::__construct(new ClienteDAO());
    $this->enderecoDAO = new EnderecoDAO();
  }

  public function post() {
    echo json_encode("ClienteController");
  }

  public function get(){
    $response = array();
    $consulta = $this->dao->buscarTodos();
    
    while ($row = oci_fetch_array($consulta, OCI_NUM)) {

      $getEnd = oci_fetch_array($this->enderecoDAO->buscar($row[6]), OCI_NUM);

      $endereco = new Endereco($getEnd[0], $getEnd[1], $getEnd[2], $getEnd[3], $getEnd[4], $getEnd[5], $getEnd[6]);

      $obj = new Cliente($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $endereco);
      array_push($response, $obj);
    }
    
    echo json_encode($response);
  }
}

$controller = new ClienteController();
$controller->listen();

?>