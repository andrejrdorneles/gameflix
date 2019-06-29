<?php
  require_once('Base.dao.php');

  class EnderecoDAO extends BaseDAO {
    function __construct(){
      parent::__construct("Endereco",
       array("rua", "numero", "bairro", "cidade", "estado", "cep"));
    }
  }
?>