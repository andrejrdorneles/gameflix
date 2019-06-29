<?php
  require_once('Base.dao.php');

  class LocacaoDAO extends BaseDAO {
    function __construct(){
      parent::__construct("Locacao", 
        array("datalocacao", "datadevolucao", "status", "idmidia", "idpedido"));
    }
  }
?>