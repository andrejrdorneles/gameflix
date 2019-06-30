<?php
  require_once('Base.dao.php');
  require_once('../entidades/Endereco.class.php');

  class EnderecoDAO extends BaseDAO {
    function __construct(){
      parent::__construct("Endereco",
       array("rua", "numero", "bairro", "cidade", "estado", "cep"));
    }

    function buscar($id){
      $result = oci_fetch_array(parent::buscar($id), OCI_NUM);

      return $this->mapear($result);
    }

    function mapear($row){
      return new Endereco($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
    }
  }
?>