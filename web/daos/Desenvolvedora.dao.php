<?php
  require_once('Base.dao.php');

  class DesenvolvedoraDAO extends BaseDAO {
    function __construct(){
      parent::__construct("Desenvolvedora", array("nome", "diasLocacao"));
    }
  }
?>