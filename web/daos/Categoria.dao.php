<?php
  require_once('Base.dao.php');

  class CategoriaDAO extends BaseDAO {
    function __construct(){
      parent::__construct("CATEGORIA", array("nome", "diasLocacao"));
    }
  }
?>