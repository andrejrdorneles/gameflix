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
        array("status", "valor_total", "valor_quitado", "data_retirada", "id_cliente", "id_operador"));
      $this->clienteDAO = new ClienteDAO();
      $this->operadorDAO = new OperadorDAO();
      $this->locacaoDAO = new LocacaoDAO();
    }

    function buscar($id){
      $result = oci_fetch_array(parent::buscar($id), OCI_NUM);

      return $this->mapear($result);
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

    function inserir($valores){
      $valores = $array = get_object_vars($valores);
      $result = parent::inserir($valores);
      
      return $this->mapearArray($result, $valores);
    }

    function atualizar($valores){
      $valores = $array = get_object_vars($valores);
      $result = parent::atualizar($valores);
      
      return $this->buscar($valores['id']);
    }

    function mapearArray($result, $valores){
      return $this->mapear(array($result, $valores[$this->insertArray[0]], 
        $valores[$this->insertArray[1]], $valores[$this->insertArray[2]],
        $valores[$this->insertArray[3]], $valores[$this->insertArray[4]],
        $valores[$this->insertArray[5]]));
    }

    function mapear($row){
      $cliente = $this->clienteDAO->buscar($row[5]);
      $operador = $this->operadorDAO->buscar($row[6]);
      $locacoes = $this->locacaoDAO->buscarPorIdPedido($row[0]);
      return new Pedido($row[0], Status::get($row[1]), $row[2], $row[3], $row[4], $cliente, $operador, $locacoes);
    }
  }
?>