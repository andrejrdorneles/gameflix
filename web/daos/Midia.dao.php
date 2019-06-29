<?php
  require_once('Base.dao.php');

  class MidiaDAO extends BaseDAO {
    function __construct(){
      parent::__construct("Midia", 
        array("plataforma", "dataaquisicao", "precolocacao", "idjogo", "idcategoria"));
    }
  }
?>