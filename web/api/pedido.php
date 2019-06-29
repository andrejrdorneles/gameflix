<?php
require_once('Base.controller.php');
require_once('../daos/Operador.dao.php');
require_once('../daos/Endereco.dao.php');
require_once('../daos/Cliente.dao.php');
require_once('../daos/Pedido.dao.php');
require_once('../entidades/Operador.class.php');
require_once('../entidades/Endereco.class.php');
require_once('../entidades/Cliente.class.php');
require_once('../entidades/Pedido.class.php');

class PedidoController extends BaseController {
  private $operadorDAO;
  private $clienteDAO;
  private $enderecoDAO;

  function __construct(){
    parent::__construct(new PedidoDAO());
    $this->operadorDAO = new OperadorDAO();
    $this->clienteDAO = new ClienteDAO();
    $this->enderecoDAO = new EnderecoDAO();
  }

  public function post() {
    echo json_encode("PedidoController");
  }

  public function get(){
    $response = array();
    $consulta = $this->dao->buscarTodos();
    
    while ($row = oci_fetch_array($consulta, OCI_NUM)) {

      $getOperador = oci_fetch_array($this->operadorDAO->buscar($row[6]), OCI_NUM);
      $getCliente = oci_fetch_array($this->clienteDAO->buscar($row[5]), OCI_NUM);
      $getEnd = oci_fetch_array($this->enderecoDAO->buscar($getCliente[6]), OCI_NUM);

      $operador = new Operador($getOperador[0], $getOperador[1], $getOperador[2], $getOperador[3], $getOperador[4]);
      $endereco = new Endereco($getEnd[0], $getEnd[1], $getEnd[2], $getEnd[3], $getEnd[4], $getEnd[5], $getEnd[6]);
      $cliente = new Cliente($getCliente[0], $getCliente[1], $getCliente[2], $getCliente[3], $getCliente[4], $getCliente[5], $endereco);

      $obj = new Pedido($row[0], $row[1], $row[2], $row[3], $row[4], $cliente, $operador);
      array_push($response, $obj);
    }
    
    echo json_encode($response);
  }
}

$controller = new PedidoController();
$controller->listen();

?>