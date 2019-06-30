<?php
  require_once('Base.dao.php');
  require_once('../entidades/Locacao.class.php');
  require_once('../entidades/Status.enum.php');
  require_once('../daos/Midia.dao.php');

  class LocacaoDAO extends BaseDAO {
    
    private $midiaDAO;

    function __construct(){
      parent::__construct("Locacao", 
        array("datalocacao", "datadevolucao", "status", "idmidia", "idpedido"));
      $this->midiaDAO = new MidiaDAO();
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

    function mapear($row){
      $midia = $this->midiaDAO->buscar($row[4]);
      return new Locacao($row[0], $row[1], $row[2], Status::get($row[3]), $midia, $row[5]);
    }
  }
?>