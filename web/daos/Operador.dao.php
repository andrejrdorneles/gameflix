<?php
  require_once('Base.dao.php');

  class OperadorDAO extends BaseDAO {
    function __construct(){
      parent::__construct("Operador", 
        array("nome", "login", "senha", "urlImagem"));
    }
  }
?>