<?php
  require_once('Base.dao.php');

  class ClienteDAO extends BaseDAO {
    function __construct(){
      parent::__construct("Cliente", 
        array("cpf", "nome", "telefone", "email", "datanascimento", "idendereco"));
    }
  }
?>