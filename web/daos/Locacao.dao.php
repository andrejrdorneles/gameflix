<?php
  require_once('Base.dao.php');
  require_once('../entidades/Locacao.class.php');
  require_once('../entidades/Status.enum.php');
  require_once('../daos/Midia.dao.php');

  class LocacaoDAO extends BaseDAO {
    
    private $midiaDAO;

    function __construct(){
      parent::__construct("Locacao", 
        array("data_locacao", "data_devolucao", "status", "id_midia", "id_pedido"));
      $this->midiaDAO = new MidiaDAO();
    }

    function buscar($id){
      $result = oci_fetch_array(parent::buscar($id), OCI_NUM);

      return $this->mapear($result);
    }

    function buscarTodos(){
      $response = array();
      $consulta = parent::buscarTodos();
      
      while ($row = oci_fetch_array($consulta, OCI_NUM)) {
        $obj = $this->mapear($row);
        array_push($response, $obj);
      }

      return $response;
    }

    function buscarPorIdPedido($id){
      $response = array();
      $consulta = parent::buscarPorCampoEValor("idpedido", $id);
      
      while ($row = oci_fetch_array($consulta, OCI_NUM)) {
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
        $valores[$this->insertArray[3]], $valores[$this->insertArray[4]]));
    }

    function mapear($row){
      $midia = $this->midiaDAO->buscar($row[4]);
      return new Locacao($row[0], $row[1], $row[2], Status::get($row[3]), $midia, $row[5]);
    }
  }
?>