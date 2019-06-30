<?php
  require_once('Base.dao.php');
  require_once('../entidades/Desenvolvedora.class.php');

  class DesenvolvedoraDAO extends BaseDAO {
    function __construct(){
      parent::__construct("Desenvolvedora", array("nome", "url_imagem"));
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

    function buscar($id){
      $result = oci_fetch_array(parent::buscar($id), OCI_NUM);

      return $this->mapear($result);
    }

    function inserir($valores){
      $result = parent::inserir($valores);
      
      return $this->mapearArray($result, $valores);
    }

    function mapearArray($id, $objeto){
      return $this->mapear(array($id, $objeto->nome, $objeto->url_imagem));
    }

    function mapear($row){
      return new Desenvolvedora($row[0], $row[1], $row[2]);
    }
  }
?>