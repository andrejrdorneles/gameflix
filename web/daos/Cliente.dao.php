<?php
  require_once('Base.dao.php');
  require_once('../entidades/Cliente.class.php');
  require_once('../daos/Endereco.dao.php');

  class ClienteDAO extends BaseDAO {
    private $enderecoDAO;

    function __construct(){
      parent::__construct("Cliente", 
        array("cpf", "nome", "telefone", "email", "datanascimento", "idendereco"));
      $this->enderecoDAO = new EnderecoDAO();
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

    function buscar($id){
      $result = oci_fetch_array(parent::buscar($id), OCI_NUM);

      return $this->mapear($result);
    }

    function mapear($row){
      $endereco = $this->enderecoDAO->buscar($row[6]);
      return new Cliente($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $endereco);
    }
  }
?>