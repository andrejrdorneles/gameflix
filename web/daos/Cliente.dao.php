<?php
  require_once('Base.dao.php');
  require_once('../entidades/Cliente.class.php');
  require_once('../daos/Endereco.dao.php');

  class ClienteDAO extends BaseDAO {
    private $enderecoDAO;

    function __construct(){
      parent::__construct("Cliente", 
        array("cpf", "nome", "telefone", "email", "data_nascimento", "id_endereco"));
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

    function inserir($valores){
      $valores = $array = get_object_vars($valores);
      $id_endereco = $this->enderecoDAO->inserir($valores);
      $valores["id_endereco"] = $id_endereco;
      $result = parent::inserir($valores);
      
      return $this->mapearArray($result, $valores, $id_endereco);
    }

    function mapearArray($result, $valores){
      return $this->mapear(array($result, $valores[$this->insertArray[0]], 
        $valores[$this->insertArray[1]], $valores[$this->insertArray[2]],
        $valores[$this->insertArray[3]], $valores[$this->insertArray[4]],
        $valores[$this->insertArray[5]]));
    }

    function mapear($row){
      $endereco = $this->enderecoDAO->buscar($row[6]);
      return new Cliente($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $endereco);
    }
  }
?>