<?php
  require_once('Base.dao.php');

  class JogoDAO extends BaseDAO {
    function __construct(){
      parent::__construct("Jogo", 
        array("nome", "urlImagem", "genero", "dataLancamento", "idDesenvolvedora"));
    }
  }
?>