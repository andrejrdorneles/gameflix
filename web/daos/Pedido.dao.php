<?php
  require_once('Base.dao.php');
  require_once('../entidades/Pedido.class.php');
  require_once('../entidades/Status.enum.php');
  require_once('../daos/Operador.dao.php');
  require_once('../daos/Cliente.dao.php');
  require_once('../daos/Locacao.dao.php');

  class PedidoDAO extends BaseDAO {

    public $clienteDAO;
    public $operadorDAO;
    public $locacaoDAO;
    
    function __construct(){
      parent::__construct("Pedido", 
        array("status", "valortotal", "valorquitado", "dataretirada", "idcliente", "idoperador"));
      $this->clienteDAO = new ClienteDAO();
      $this->operadorDAO = new OperadorDAO();
      $this->locacaoDAO = new LocacaoDAO();
    }

    function buscarTodos(){
      $response = array();
      $result = parent::buscarTodos();
      
      while ($row = oci_fetch_array($result, OCI_NUM)) {
        $obj = $this->mapear($row);
        array_push($response, $obj);
      }

      return $response;
    }

    function mapear($row){
      $cliente = $this->clienteDAO->buscar($row[5]);
      $operador = $this->operadorDAO->buscar($row[6]);
      $locacoes = $this->locacaoDAO->buscarPorIdPedido($row[0]);
      return new Pedido($row[0], Status::get($row[1]), $row[2], $row[3], $row[4], $cliente, $operador, $locacoes);
    }
  }
?>