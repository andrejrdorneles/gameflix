<?php
  class Categoria {
    private $id;
    private $nome;
    private $dias_locacao;
    private $preco;

    function __construct($nome, $dias_locacao, $preco){
      $this->nome = $nome;
      $this->dias_locacao = $dias_locacao;
      $this->preco = $preco;
    }
  }
?>