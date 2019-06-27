<?php
  class Categoria {
    private $id;
    private $nome;
    private $dias_locacao;

    function __construct($nome, $dias_locacao, $id){
      $this->nome = $nome;
      $this->dias_locacao = $dias_locacao;
      $this->id = $id;
    }
  }
?>